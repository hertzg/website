#!/bin/bash
cd `dirname $BASH_SOURCE`
for i in *.php
do
    echo -n "Running $i... "
    php $i
done
