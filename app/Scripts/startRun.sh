#!/bin/bash

RUN_DIR=$1
echo $RUN_DIR
echo "Start Run Script Started"
echo "running" > $RUN_DIR/status.log
docker run -v $RUN_DIR/workingDir:/workingdir oncogx/pinaplpy_docker /bin/bash -c "python -u /opt/PinAPL-Py/Scripts/PinAPL.py > /workingdir/output.log 2>&1"
echo "finished" > $RUN_DIR/status.log