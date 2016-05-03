#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/cli.php';
include_once '../../../lib/defaults.php';
include_once '../../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'delete from admin_api_key_auths'
    .' where id_admin_api_keys not in (select id from admin_api_keys)';
$mysqli->query($sql) || trigger_error($mysqli->error);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $mysqli->affected_rows row(s) deleted.\n";
