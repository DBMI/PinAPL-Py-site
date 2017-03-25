#!/bin/bash

RUN_DIR=$1
NUM_CORES=$2
echo $RUN_DIR
echo "Start Run Script Started"
echo "running" > $RUN_DIR/status.log
docker run --rm --cpus="$2" -v $RUN_DIR/workingDir:/workingdir oncogx/pinaplpy_docker:beta_v2.4.1 /bin/bash -c "python -u /opt/PinAPL-Py/Scripts/PinAPL.py > /workingdir/output.log 2>&1 && chown -R www-data:www-data /workingdir"
echo "finished" > $RUN_DIR/status.log
