#!/bin/bash
cd `dirname $BASH_SOURCE`
cd ../..
for i in `find -type f -name "*.php"`
do
    echo $i | cut --characters=3-
    php -l $i > /dev/null || exit 1
done
