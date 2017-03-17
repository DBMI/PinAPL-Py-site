
#!/bin/bash

# Change directory to where the script is stored, not run from
scriptPath=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
cd $scriptPath/..
sitePath=$(pwd)

sudo apt -qq install npm
sudo apt -qq install zip
sudo apt -qq install php-zip
sudo apt -qq install php-xml
sudo apt -qq install php-dom
sudo apt -qq install php-mbstring
sudo phpenmod zip
sudo npm install -g forever

sudo apt -qq install supervisor

# Setup and start queue
sudo ln -s $sitePath/setup/pinapl-worker.conf /etc/supervisor/conf.d/pinapl-worker.conf
sudo ln -s $sitePath/setup/pinapl-worker-monitor.conf /etc/supervisor/conf.d/pinapl-worker-monitor.conf
sudo ln -s $sitePath/setup/pinapl-worker-start-run.conf /etc/supervisor/conf.d/pinapl-worker-start-run.conf


$scriptPath/startSupervisor.sh

# Start Kotrans server
$scriptPath/startKoTrans.sh

echo "Please ensure the system has enough ram 24gb minimum per concurrant run"
echo "Please edit your php.ini file and change max_filesize to allow 1G uploads"

