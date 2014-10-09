#!/bin/bash
cd `dirname $BASH_SOURCE`
cd ../..
for i in `find -type f -name "*.js"`
do
    echo $i | cut -c 3-
    if [ -x $i ]
    then
        tail -n +2 $i | uglifyjs --lint > /dev/null
    else
        uglifyjs --lint $i > /dev/null
    fi
done
