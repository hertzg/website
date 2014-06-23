<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$sql = 'alter table received_files add committed tinyint not null after archived';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table received_folders add committed tinyint not null after archived';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'update received_files set committed = 1';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'update received_folders set committed = 1';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
