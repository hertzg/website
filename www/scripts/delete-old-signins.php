#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$insert_time = time() - 2 * 30 * 24 * 60 * 60;

$sql = "delete from signins where insert_time < $insert_time";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "delete from invalid_signins where insert_time < $insert_time";
$mysqli->query($sql) || trigger_error($mysqli->error);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
