#!/bin/bash
cd `dirname $BASH_SOURCE`
for i in */build.js
do
    ./$i
done
