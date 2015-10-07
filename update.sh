#!/bin/bash
cd `dirname $BASH_SOURCE`
git fetch
while true
do

    current=`git describe --tags --abbrev=0`
    next=`git tag | sort -V | grep -A 1 $current | tail -1`

    if [ $current = $next ]
    then
        exit
    fi

    git checkout -q $current
    echo "Upgrading from $current to $next..."
    git checkout -q $next

    file=www/scripts/update.php
    if [ -f $file ]
    then
        php $file
    fi

done
