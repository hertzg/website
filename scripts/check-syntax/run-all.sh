#!/bin/bash
cd `dirname $BASH_SOURCE`
for i in js php sh
do
    ./$i.sh
done
