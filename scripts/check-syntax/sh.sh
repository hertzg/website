#!/bin/bash
cd `dirname $BASH_SOURCE`
cd ../..
for i in `find -type f -name "*.sh"`
do
    echo $i
    bash -n $i
done
