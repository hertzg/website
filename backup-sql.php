#!/usr/bin/php
<?php

chdir(__DIR__);

include_once 'www/fns/get_mysqli_config.php';
get_mysqli_config($host, $username, $password, $db);

$command = 'mysqldump --host='.escapeshellarg($host)
    .' --user='.escapeshellarg($username)
    .' --password='.escapeshellarg($password)
    .' --databases '.escapeshellarg($db)
    .' > backup-sql.sql';
system($command);
system("tar czf backup-sql.tgz backup-sql.sql");
unlink('backup-sql.sql');
