#!/bin/bash

function render () {
    dir=`pwd`
    cd $1/inkscape
    for i in *.svg
    do
        name=`basename $i .svg`
        inkscape --export-plain-svg=../$name.svg $name.svg
    done
    cd $dir
}

cd `dirname $BASH_SOURCE`
cd ..

render zvini-icons
render images
render images/icons

for i in themes/*
do
    render $i/images
done

convert zvini-icons/16.svg favicon.ico
