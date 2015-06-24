#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$insert_time = time() - 2 * 30 * 24 * 60 * 60;

include_once '../fns/Signins/deleteOlder.php';
Signins\deleteOlder($mysqli, $insert_time);

include_once '../fns/InvalidSignins/deleteOlder.php';
InvalidSignins\deleteOlder($mysqli, $insert_time);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
