#!/bin/bash
cd `dirname $BASH_SOURCE`
git fetch
git checkout -q `git describe --tags --abbrev=0`
while true
do

    current=`git tag --contains | grep ^v | sort -V | head -1`
    next=`git tag --contains | grep ^v | sort -V | head -2 | tail -1`

    if [ $current = $next ]
    then
        exit
    fi

    echo "Upgrading from $current to $next..."
    git checkout -q $next

    file=www/scripts/update.php
    if [ -f $file ]
    then
        php $file
    fi

done
