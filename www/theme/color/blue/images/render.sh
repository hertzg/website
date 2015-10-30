#!/bin/bash
cd `dirname $BASH_SOURCE`
for i in icon*.svg
do
    name=`basename $i .svg`
    inkscape --export-png=$name.png $name.svg > /dev/null
    optipng -quiet -o 7 -strip all $name.png
done
