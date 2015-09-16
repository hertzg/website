#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

$sql = "update users set notes_order_by = 'update_time desc',"
    ." tasks_order_by = 'update_time desc'";
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
