<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$sql = "alter table deleted_files add media_type enum('audio', 'video', 'image') after insert_time";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "alter table files add media_type enum('audio', 'video', 'image') after insert_time";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "alter table received_files add media_type enum('audio', 'video', 'image') after insert_time";
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "alter table received_folder_files add media_type enum('audio', 'video', 'image') after id_users";
$mysqli->query($sql) || trigger_error($mysqli->error);

echo "Done\n";
