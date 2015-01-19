#!/usr/bin/php
<?php

chdir(__DIR__);
include_once 'lib/cli.php';

system('tar xf backup-sql.tgz');

include_once 'www/fns/MysqlConfig/get.php';
MysqlConfig\get($host, $username, $password, $db);

$command = 'mysql --host='.escapeshellarg($host)
    .' --user='.escapeshellarg($username)
    .' --password='.escapeshellarg($password)
    .' '.escapeshellarg($db).' < backup-sql.sql';
system($command);
unlink('backup-sql.sql');
