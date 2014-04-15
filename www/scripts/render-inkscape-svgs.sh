#!/bin/bash

cd `dirname $BASH_SOURCE`
cd ../images/inkscape
for i in *.svg
do
    name=`basename $i .svg`
    inkscape --export-plain-svg=../$name.svg $name.svg
done
