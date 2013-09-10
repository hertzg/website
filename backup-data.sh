#!/bin/bash
cd `dirname $BASH_SOURCE`
mysqldump -h173.201.214.106 -uzviniwww -pJandaba7En --databases zviniwww > zviniwww.sql
tar czf backup-data.tgz www/users zviniwww.sql
rm zviniwww.sql
