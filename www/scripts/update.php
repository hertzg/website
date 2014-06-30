<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$sql = 'alter table tasks add deadline_time bigint unsigned first';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
