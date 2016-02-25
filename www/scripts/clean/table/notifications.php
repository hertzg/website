#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';
include_once '../../../../lib/defaults.php';
include_once '../../../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'delete from notifications'
    .' where id_users not in (select id_users from users)'
    .' or (id_subscribed_channels is null'
    .' and id_channels not in (select id from channels))'
    .' or (id_channels is null'
    .' and id_subscribed_channels not in (select id from subscribed_channels))';
$mysqli->query($sql) || trigger_error($mysqli->error);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $mysqli->affected_rows row(s) deleted.\n";
