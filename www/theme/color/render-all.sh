#!/bin/bash
cd `dirname $BASH_SOURCE`
for i in */images
do
    cd $i
    ./inkscape/render.sh
    ./render.sh
    cd ../..
done
