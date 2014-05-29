<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$sql = 'alter table received_bookmarks add archived tinyint unsigned not null first';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table received_contacts add archived tinyint unsigned not null first';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table received_files add archived tinyint unsigned not null first';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table received_notes add archived tinyint unsigned not null first';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table received_tasks add archived tinyint unsigned not null first';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
