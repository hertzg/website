#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/cli.php';
include_once '../../../lib/defaults.php';
include_once '../../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'delete from received_folders'
    .' where sender_id_users not in (select id_users from users)'
    .' or receiver_id_users not in (select id_users from users)';
$mysqli->query($sql) || trigger_error($mysqli->error);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $mysqli->affected_rows row(s) deleted.\n";
