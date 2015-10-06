#!/bin/bash
cd `dirname $BASH_SOURCE`
git fetch
current=`git describe --tags --abbrev=0`
git checkout $current
next=`git tag | sort -V | grep -A 1 $current | tail -1`
echo "Current tag: $current"
echo "Next tag: $next"
git checkout $next

file=www/scripts/update.php
if [ -f $file ]
then
    php $file
fi
