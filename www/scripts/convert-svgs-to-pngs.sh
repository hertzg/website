#!/bin/bash

function render () {
    name=$1
    convert -background transparent -depth 8 "$name.svg" "$name.png"
    optipng -quiet -o7 -strip all $name.png
}

cd `dirname $BASH_SOURCE`

cd ../zvini-icons
for i in 16 32 60 64 90 120 128 256
do
    render $i
done

cd ../themes
for i in *
do
    cd $i
    cd images
    render icon16
    render icon32
    cd ../..
done
