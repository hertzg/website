#!/bin/bash

function convert_and_compress () {
    for i in *.svg
    do
        name=`basename $i .svg`
        convert -background transparent -depth 8 "$name.svg" "$name.png"
    done
    optipng -quiet -o7 -strip all *.png
}

cd `dirname $BASH_SOURCE`

cd ../zvini-icons
convert_and_compress
cd ../images
convert_and_compress
cd ..

convert zvini-icons/16.png favicon.ico

cd themes
for i in *
do
    cd $i/images
    convert_and_compress
    cd ../..
done
