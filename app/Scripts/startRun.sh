#!/bin/bash

RUN_DIR=$1
echo $RUN_DIR
echo "Start Run Script Started"
echo "running" > $RUN_DIR/status.log

docker run -v $RUN_DIR/workingDir:/workingdir oncogx/pinaplpy_docker PinAPL.py
echo "finished" > $RUN_DIR/status.log