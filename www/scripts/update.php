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

$sql = 'alter table users'
    .' add num_archived_received_bookmarks bigint unsigned not null,'
    .' add num_archived_received_contacts bigint unsigned not null,'
    .' add num_archived_received_files bigint unsigned not null,'
    .' add num_archived_received_notes bigint unsigned not null,'
    .' add num_archived_received_tasks bigint unsigned not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
