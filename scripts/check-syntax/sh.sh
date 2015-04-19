#!/bin/bash
cd `dirname $BASH_SOURCE`
cd ../..
for i in `find -type f -name "*.sh"`
do
    echo $i | cut -c 3-
    bash -n $i || exit 1
done
