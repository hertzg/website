#!/bin/bash
cd `dirname $BASH_SOURCE`
for i in */images
do
    ./$i/inkscape/render.php
    ./$i/render.sh
done
