#!/bin/bash

# Change directory to where the script is stored, not run from
scriptPath=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
cd $scriptPath/..
sitePath=$(pwd)

sudo apt -qq install npm
sudo npm install -g forever

sudo apt -qq install supervisor

# Setup and start queue
sudo ln -s $sitePath/setup/pinapl-worker.conf /etc/supervisor/conf.d/pinapl-worker.conf
$scriptPath/startSupervisor.sh

# Start Kotrans server
$scriptPath/startKoTrans.sh
