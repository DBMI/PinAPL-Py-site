#!/bin/bash

RUN_DIR=$1
echo $RUN_DIR
echo "Start Run Script Started"
echo "running" > $RUN_DIR/status.log
docker run --rm -v $RUN_DIR/workingDir:/workingdir oncogx/pinaplpy_docker:beta_v1.0.0 /bin/bash -c "python -u /opt/PinAPL-Py/Scripts/PinAPL.py > /workingdir/output.log 2>&1 && chown -R www-data:www-data /workingdir"
echo "finished" > $RUN_DIR/status.log
