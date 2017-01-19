#!/bin/bash

# Get the location where this script is stored
scriptPath=$(cd -P -- "$(dirname -- "$0")" && pwd -P)

# Navigate to root of site
cd $scriptPath/..
cd ..

# Use forever to launch kotrans
forever start public/js/kotrans/server.js &