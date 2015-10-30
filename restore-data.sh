#!/bin/bash
cd `dirname $BASH_SOURCE`
tar --extract --touch --file=backup-data.tgz
