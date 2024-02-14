#!/bin/bash

# Get the location where this script is stored
scriptPath=$(cd -P -- "$(dirname -- "$0")" && pwd -P)
logDir=$(readlink -f "$scriptPath/../storage/logs/")
logFile="$logDir/forever.log"
kotransLog="$logDir/kotrans.log"
kotransError="$logDir/kotransError.log"
script=public/js/kotrans/server.js
export HOME="$logDir"
cd $scriptPath/..
#forever --plain list
#forever --plain stop "$script"

if [ -f "$logFile" ]; then
	mv "$logFile" "$logFile".old
fi
if [ -f "$kotransLog" ]; then
	mv "$kotransLog" "$kotransLog".old
fi
if [ -f "$kotransError" ]; then
	mv "$kotransError" "$kotransError".old
fi
# Navigate to root of site

# Use forever to launch kotrans
#forever --plain -p "$logDir" -l "$logFile" -o "$kotransLog" -e "$kotransError" -a start "$script" &
echo '/usr/local/bin/pm2 --log "$logFile" --output "$kotransLog" --error "$kotransError" --name "kotrans" start "$script"'

/usr/local/bin/pm2 --log "$logFile" --output "$kotransLog" --error "$kotransError" --name "kotrans" start public/js/kotrans/server.js -f


