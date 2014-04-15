#!/bin/bash

function render () {
    for i in *.svg
    do
        name=`basename $i .svg`
        inkscape --export-plain-svg=../$name.svg $name.svg
    done
}

cd `dirname $BASH_SOURCE`

cd ../images/inkscape
render

cd ../../themes
for i in *
do
    cd $i
    cd images/inkscape
    render
    cd ../../..
done
