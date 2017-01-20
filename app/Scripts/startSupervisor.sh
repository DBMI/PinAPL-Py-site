#!/bin/bash

sudo supervisorctl reread
sudo supervisorctl update
sudo supervisorctl start pinapl-worker:*