#!/bin/bash
for i in *.php
do
    echo "Running $i..."
    php $i
done
