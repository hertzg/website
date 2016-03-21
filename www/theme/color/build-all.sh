#!/bin/bash
cd `dirname $BASH_SOURCE`
for i in */build.php
do
    ./$i
done
