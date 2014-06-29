<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$sql = 'alter table users change num_new_notifications_for_home home_num_new_notifications bigint unsigned not null after insert_time';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table users add home_num_new_received_bookmarks bigint unsigned not null after home_num_new_notifications';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table users add home_num_new_received_contacts bigint unsigned not null after home_num_new_received_bookmarks';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table users add home_num_new_received_files bigint unsigned not null after home_num_new_received_contacts';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table users add home_num_new_received_notes bigint unsigned not null after home_num_new_received_files';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table users add home_num_new_received_tasks bigint unsigned not null after home_num_new_received_notes';
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
