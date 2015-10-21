#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

$sql = 'alter table users'
    .' change num_logins num_signins bigint(20) unsigned not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table users'
    .' change last_login_time last_signin_time bigint(20) unsigned';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
