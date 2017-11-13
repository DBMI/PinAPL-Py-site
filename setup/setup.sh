
#!/bin/bash

# Change directory to where the script is stored, not run from
scriptPath=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
cd $scriptPath/..
sitePath=$(pwd)


echo -e "\e[1mInstalling required packages\e[0m"

sudo apt -qq install npm
sudo apt -qq install zip
sudo apt -qq install php-zip
sudo apt -qq install php-xml
sudo apt -qq install php-dom
sudo apt -qq install php-mbstring
sudo phpenmod zip
sudo npm install -g forever

sudo apt -qq install supervisor

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
echo "Please provide a password for the PinAPL-py user"
read -s mysqlPass
if [[ -n $mysqlRoot ]]; then
	passFlag="-p$mysqlRoot"
else
	passFlag=""
fi
mysql -u root $passFlag -e "CREATE DATABASE pinaplpy"
mysql -u root $passFlag -e "CREATE USER 'pinaplpy'@'localhost' IDENTIFIED BY '$mysqlPass'"
mysql -u root $passFlag -e "Grant ALL ON pinaplpy.* TO 'pinaplpy'@'localhost'"
mysql -u root $passFlag -e "FLUSH PRIVILEGES"


sed -i "s/DB_PASSWORD=secret/DB_PASSWORD=${mysqlPass}/g" .env

echo -e "\e[1mSetting up Database\e[0m"
php artisan migrate

echo -e "\e[1mSetting up Apache\e[0m"
a2enmod rewrite
service apache2 restart


echo -e "\e[1mMoving Files\e[0m"
cp .env.example .env

# Setup and start queue
sudo ln -s $sitePath/setup/pinapl-worker.conf /etc/supervisor/conf.d/pinapl-worker.conf
sudo ln -s $sitePath/setup/pinapl-worker-monitor.conf /etc/supervisor/conf.d/pinapl-worker-monitor.conf
sudo ln -s $sitePath/setup/pinapl-worker-start-run.conf /etc/supervisor/conf.d/pinapl-worker-start-run.conf

# ################################
# Change ownership and permisions
# ################################
echo -e "\e[1mChanging File Permissions for $sitePath\e[0m"
chown -R www-data:www-data $sitePath
chmod -R 775 $sitePath

# Start Supervisor
echo -e "\e[1mStarting Supervisor (Queue Management)\e[0m"
$scriptPath/startSupervisor.sh

# Start Kotrans server
echo -e "\e[1mStarting KoTrans (File Upload Server)\e[0m"
$scriptPath/startKoTrans.sh

echo "\e[1mPlease ensure the system has enough ram. We reccomend a few GB more then the largest file you plan to run.\e[0m"
echo "\e[1mPlease edit your php.ini file and change max_filesize to allow 1G uploads.\e[0m"
echo "\e[1mPlease install docker. Visit https://docs.docker.com/engine/installation/ for instructions.\e[0m"

