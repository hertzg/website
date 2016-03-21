#!/bin/bash
cd `dirname $BASH_SOURCE`
for i in */images
do
    ./$i/inkscape/render.sh
    ./$i/render.sh
done
