#!/bin/bash
cd `dirname $BASH_SOURCE`
echo "Running find-extra-new-lines..."
./find-extra-new-lines.js
echo "Running find-extra-spaces..."
./find-extra-spaces.js
echo "Running find-large-files..."
./find-large-files.js
echo "Running find-long-lines..."
./find-long-lines.js
echo "Running find-trailing-spaces..."
./find-trailing-spaces.js
