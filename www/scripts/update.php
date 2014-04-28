<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$insert_time = time();
$mysqli->query("update channels set insert_time = $insert_time");
