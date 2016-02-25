#!/usr/bin/php
<?php

chdir(__DIR__);
include_once 'lib/cli.php';
include_once 'lib/defaults.php';

include_once 'www/fns/MysqlConfig/get.php';
MysqlConfig\get($host, $username, $password, $db);

$command = 'mysqldump --host='.escapeshellarg($host)
    .' --user='.escapeshellarg($username)
    .' --password='.escapeshellarg($password)
    .' --databases '.escapeshellarg($db)
    .' --hex-blob > backup-sql.sql';
system($command);
system("tar --create --gzip --file=backup-sql.tgz backup-sql.sql");
unlink('backup-sql.sql');
