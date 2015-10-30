#!/bin/bash
cd `dirname $BASH_SOURCE`
git fetch
git checkout --quiet `git describe --tags --abbrev=0`
while true
do

    sort='sort --version-sort'
    current=`git tag --contains | grep ^v | $sort | head -1`
    next=`git tag --contains | grep ^v | $sort | head -2 | tail -1`

    if [ $current = $next ]
    then
        exit
    fi

    echo "Upgrading from $current to $next..."
    git checkout --merge --quiet $next

    file=www/scripts/update.php
    if [ -f $file ]
    then
        php $file
    fi

done
