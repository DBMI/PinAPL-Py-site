#!/bin/bash
sudo supervisord
sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start pinapl-worker:*
sudo supervisorctl start pinapl-worker-monitor:*
sudo supervisorctl start pinapl-worker-start-run:*