<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$sql = 'alter table notes add encrypt tinyint unsigned not null first';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table note_tags add encrypt tinyint unsigned not null first';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table received_notes add encrypt tinyint unsigned not null first';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
