#!/bin/bash

function render () {
    for i in *.svg
    do
        name=`basename $i .svg`
        inkscape --export-plain-svg=../$name.svg $name.svg
    done
}

cd `dirname $BASH_SOURCE`

cd ../zvini-icons/inkscape
render
convert 16.svg ../../favicon.ico
cd ../../images/inkscape
render
cd ../icons/inkscape
render

cd ../../../themes
for i in *
do
    cd $i
    cd images/inkscape
    render
    cd ../../..
done
