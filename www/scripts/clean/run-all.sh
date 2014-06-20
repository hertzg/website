#!/bin/bash
cd `dirname $BASH_SOURCE`
for i in */run-all.sh
do
    echo -n "Running $i... "
    ./$i
done
