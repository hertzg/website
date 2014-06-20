#!/bin/bash
for i in *.php
do
    echo -n "Running $i... "
    php $i
done
