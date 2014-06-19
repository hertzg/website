#!/bin/bash

cd `dirname $BASH_SOURCE`
cd ../zvini-icons
for i in *.svg
do
    name=`basename $i .svg`
    convert -background transparent -depth 8 "$name.svg" "$name.png"
done
optipng -quiet -o7 -strip all *.png
