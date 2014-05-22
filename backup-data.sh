#!/bin/bash
cd `dirname $BASH_SOURCE`
mysqldump -hlocalhost -uzviniwww -p --databases zviniwww > zviniwww.sql
tar czf backup-data.tgz www/users zviniwww.sql
rm zviniwww.sql
