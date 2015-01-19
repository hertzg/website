#!/bin/bash
cd `dirname $BASH_SOURCE`
tar czf backup-data.tgz www/data --exclude=*.*
