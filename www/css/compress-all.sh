#!/bin/bash
cd `dirname $BASH_SOURCE`
for i in */compress.js
do
    ./$i
done
