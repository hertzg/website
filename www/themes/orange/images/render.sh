#!/bin/bash

function render () {
    inkscape --export-png=$1.png $1.svg > /dev/null
    optipng -q -o 7 -strip all $1.png
}

cd `dirname $BASH_SOURCE`
render icon16
render icon32
