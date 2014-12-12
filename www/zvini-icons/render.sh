#!/bin/bash

function render () {
    inkscape --export-png=$1.png $1.svg > /dev/null
    optipng -q -o 7 -strip all $1.png
}

cd `dirname $BASH_SOURCE`
render 48
render 60
render 64
render 90
render 120
render 128
render 256
