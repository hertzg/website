#!/bin/bash
cd `dirname $BASH_SOURCE`
tar --create --gzip --file=backup-code.tgz * --exclude=*.tgz --exclude=www/data
