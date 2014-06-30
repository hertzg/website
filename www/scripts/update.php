<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$sql = 'alter table tasks add deadline_time bigint unsigned first';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table received_tasks add deadline_time bigint unsigned after archived';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
