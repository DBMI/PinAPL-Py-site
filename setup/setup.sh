
#!/bin/bash

echo -e "\e[1m"
echo "Progress updates and prompts from this script will be in this color"
echo "This script is for development enviroments only. Please use as a guide for manual installation on production enviroments"
echo "We are not liable for any problems this script may cause"
read -r -p "Would you like to continue? [y/N] " response
case "$response" in
    [yY][eE][sS]|[yY]) 
        continue
        ;;
    *)
		echo "Exiting script"
        exit 1
        ;;
esac
echo -e "\e[0m"


# Change directory to where the script is stored, not run from
scriptPath=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
cd $scriptPath/..
sitePath=$(pwd)

siteName="PinAPL-py" 
siteSafeName="pinaplpy" # Should be all lowercase and no symbols


echo -e "\e[1mInstalling required packages\e[0m"
sudo apt -qq update
sudo apt -qq install curl
sudo apt -qq install npm
sudo apt -qq install zip
sudo apt -qq install php-zip
sudo phpenmod zip
sudo apt -qq install php-xml
sudo apt -qq install php-dom
sudo apt -qq install php-mbstring
sudo npm install -g forever
sudo apt -qq install supervisor

# Install Docker 
sudo apt-get install \
    apt-transport-https \
    ca-certificates \
    curl \
    software-properties-common

curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -

curl -fsSL get.docker.com -o get-docker.sh
sudo sh get-docker.sh


# ################################
# Install Composer
# ################################
echo -e "\e[1mInstalling Composer\e[0m"
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php --filename=composer --install-dir=/bin > /dev//null
php -r "unlink('composer-setup.php');"
composer update
composer dumpautoload -o
php artisan key:generate

# ################################
# Setup MySQL
# ################################
echo -e "\e[1mSetting up MySQL\e[0m"

type mysql >/dev/null 2>&1 && mysqlInstalled=true || mysqlInstalled=false

if [[ $mysqlInstalled = true ]]; then
	echo "Please provide the root password for MySQL"
	read -s mysqlRoot
else
	echo "Please provide a root password for MySQL. It can be blank"
	read -s mysqlRoot
	echo "Now instaling mysql"
	debconf-set-selections <<< "mysql-server mysql-server/root_password password $mysqlRoot"
	debconf-set-selections <<< "mysql-server mysql-server/root_password_again password $mysqlRoot"
	apt-get -qq install mysql-server > /dev/null
fi
service mysql start
echo "Please provide a password for the $siteName user"
read -s mysqlPass
if [[ -n $mysqlRoot ]]; then
	passFlag="-p$mysqlRoot"
else
	passFlag=""
fi
mysql -u root $passFlag -e "CREATE DATABASE $siteSafeName"
mysql -u root $passFlag -e "CREATE USER '$siteSafeName'@'localhost' IDENTIFIED BY '$mysqlPass'"
mysql -u root $passFlag -e "Grant ALL ON $siteSafeName.* TO '$siteSafeName'@'localhost'"
mysql -u root $passFlag -e "FLUSH PRIVILEGES"


sed -i "s/DB_PASSWORD=secret/DB_PASSWORD=${mysqlPass}/g" .env

echo -e "\e[1mSetting up Database\e[0m"
php artisan migrate

# ################################
# Setup Apache
# ################################
echo -e "\e[1mSetting up Apache\e[0m"
# Setting up virtual host
virtualHost="/etc/apache2/sites-available/$siteSafeName.conf"
sudo cp $sitePath/setup/$siteSafeName.conf "$virtualHost"
# Set up virtualhost

sudo cat > "$virtualHost" <<EOT 
<VirtualHost ${siteSafeName}:80>
	DocumentRoot ${sitePath}
	ServerName ${siteSafeName}
	ServerAlias ${siteSafeName

	<Directory ${sitePath}>
		AllowOverride All
	</Directory>
	
	ErrorLog ${sitePath}/storage/logs/apache_error.log
	CustomLog ${sitePath}/storage/logs/apache_access.log combined
	
	XSendFile on
	XSendFilePath /var/www
</VirtualHost>
# vim: syntax=apache ts=4 sw=4 sts=4 sr noet
EOT


sudo a2ensite $siteSafeName.conf


# Add flightdeck localhost to /etc/hosts
sudo echo -e "\n127.0.0.1 $siteSafeName" >> /etc/hosts
a2enmod rewrite
service apache2 restart


echo -e "\e[1mMoving Files\e[0m"
cp .env.example .env

# Symlink all supervisor files to the supervisor directory
sudo ln -s $sitePath/setup/supervisor/* /etc/supervisor/conf.d/

# ################################
# Change ownership and permisions
# ################################
echo -e "\e[1mChanging File Permissions for $sitePath\e[0m"
sudo chown -R www-data:www-data $sitePath
sudo chmod -R 775 $sitePath

# Adding the docker group
echo -e "\e[1mAdding Current user to the docker and www-data groups\e[0m"
sudo groupadd docker
sudo usermod -aG docker $USER 
sudo usermod -aG www-data $USER

# Pulling Docker image
echo -e "\e[1mPuling Docker Image\e[0m"
regex="DOCKER_IMAGE=(.+)"
OUTPUT=$(cat .env)
[[ $OUTPUT =~ $regex ]]
DOCKER_IMAGE=${BASH_REMATCH[1]}

docker pull "$DOCKER_IMAGE"

# Start Supervisor
echo -e "\e[1mStarting Supervisor (Queue Management)\e[0m"
$scriptPath/startSupervisor.sh

# Start Kotrans server
echo -e "\e[1mStarting KoTrans (File Upload Server)\e[0m"
$scriptPath/startKoTrans.sh

echo -e "\e[1mInstall Complete. You may need to reboot\e[0m"

echo "\e[1mPlease ensure the system has enough ram. We reccomend a few GB more then the largest file you plan to run.\e[0m"
echo "\e[1mPlease edit your php.ini file and change max_filesize to allow 1G uploads.\e[0m"
echo "\e[1mPlease install docker. Visit https://docs.docker.com/engine/installation/ for instructions.\e[0m"

echo -e "\e[1mPlease ensure that the paths are correct in /etc/apache2/sites-available/$siteSafeName.conf\e[0m"
echo -e "\e[1mIt is setup for localhost use. If you would like to enable external access please replace $siteSafeName:80 with *:80, or with your url:port \e[0m"

