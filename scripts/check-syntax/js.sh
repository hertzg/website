#!/bin/bash
cd `dirname $BASH_SOURCE`
cd ../..
for i in `find -type f -name "*.js"`
do
    echo $i | cut --characters=3-
    if [ -x $i ]
    then
        tail -n +2 $i | uglifyjs --lint > /dev/null || exit 1
    else
        uglifyjs --lint $i > /dev/null || exit 1
    fi
done
