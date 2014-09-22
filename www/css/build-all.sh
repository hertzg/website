#!/bin/bash
cd `dirname $BASH_SOURCE`
for i in */build.{js,php}
do
    ./$i
done
