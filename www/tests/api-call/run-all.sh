#!/bin/bash

function run_test () {
    name=$1
    echo "Running $name..."
    ./$name.php
}

chdir `dirname $BASH_SOURCE`

run_test bookmark/general
run_test bookmark/received
run_test bookmark/send
run_test channels
run_test contact/general
run_test contact/received
run_test contact/send
run_test file/general
run_test file/subfolder
run_test folder/general
run_test folder/subfolder
run_test note/general
run_test note/received
run_test note/send
run_test notifications
run_test task/general
run_test task/received
run_test task/send
