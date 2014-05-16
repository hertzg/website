#!/bin/bash
cd `dirname $BASH_SOURCE`
./bookmark/run-all.sh
./channels.php
./contact/run-all.sh
./file/run-all.sh
./folder/run-all.sh
./note/run-all.sh
./notifications.php
./task/run-all.sh
