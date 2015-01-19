#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

$sql = 'update users set access_time = last_login_time'
    .' where last_login_time <> 0';
$mysqli->query($sql) || trigger_error($mysqli->error);

include_once '../fns/Users/emailExpireDays.php';
$access_time = time() - Users\emailExpireDays() * 24 * 60 * 60;
$sql = "update users set access_time = $access_time"
    .' where access_time is null';
$mysqli->query($sql) || trigger_error($mysqli->error);
