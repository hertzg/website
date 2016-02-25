#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';
include_once '../../../../lib/defaults.php';
include_once '../../../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'delete from contact_photos'
    .' where id not in (select photo_id from contacts)'
    .' and id not in (select photo_id from received_contacts)';
$mysqli->query($sql) || trigger_error($mysqli->error);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $mysqli->affected_rows row(s) deleted.\n";
