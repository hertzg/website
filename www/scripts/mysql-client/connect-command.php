#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/cli.php';
include_once '../../../lib/defaults.php';

include_once '../../fns/MysqlConfig/get.php';
MysqlConfig\get($host, $username, $password, $db);

echo 'mysql --host='.escapeshellarg($host)
    .' --user='.escapeshellarg($username)
    .' --password='.escapeshellarg($password)
    .' '.escapeshellarg($db)."\n";
