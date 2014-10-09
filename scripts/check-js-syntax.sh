#!/bin/bash
cd `dirname $BASH_SOURCE`
cd ..
for i in `find -type f -name "*.js"`
do
    echo $i
    if [ -x $i ]
    then
        tail -n +2 $i | uglifyjs > /dev/null
    else
        uglifyjs $i > /dev/null
    fi
done
