#!/bin/bash
cd `dirname $BASH_SOURCE`
./api-call/run-all.sh
./days_left/run.php
./date_ago.php
./date_in.php
./evaluate/index.php
./parse_latitude/index.php
./parse_longitude/index.php
