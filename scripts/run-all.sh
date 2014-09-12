#!/bin/bash
cd `dirname $BASH_SOURCE`
for i in *.js
do
    ./$i
done
