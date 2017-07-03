#!/bin/bash

RUN_DIR=$1
DATA_DIR=$2
NUM_CORES=$3
echo $RUN_DIR
echo "Start Run Script Started"
echo "running" > $RUN_DIR/status.log
docker run --rm --cpus="$NUM_CORES" -v $RUN_DIR/workingDir:/workingdir -v $DATA_DIR:/workingdir/Data oncogx/pinaplpy_docker:beta_v2.5 /bin/bash -c "python -u /opt/PinAPL-Py/Scripts/PinAPL.py > /workingdir/output.log 2>&1 && chown -R www-data:www-data /workingdir"
echo "finished" > $RUN_DIR/status.log
