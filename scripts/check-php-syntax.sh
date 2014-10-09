#!/bin/bash
cd `dirname $BASH_SOURCE`
cd ..
for i in `find -type f -name "*.php"`
do
    echo $i
    php -l $i > /dev/null
done
