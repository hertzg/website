#!/bin/bash
cd `dirname $BASH_SOURCE`
tar --create --gzip --file=backup-data.tgz www/data --exclude=*.*
