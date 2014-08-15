#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'delete from subscribed_channels'
    .' where id_channels not in (select id from channels)'
    .' or publisher_id_users not in (select id_users from users)'
    .' or subscriber_id_users not in (select id_users from users)';
$mysqli->query($sql) || trigger_error($mysqli->error);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $mysqli->affected_rows row(s) deleted.\n";
