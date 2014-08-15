#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/mysqli.php';
include_once '../../../fns/mysqli_query_object.php';

$microtime = microtime(true);
$deleted = 0;

$sql = 'delete from received_folder_files'
    .' where id_users not in (select id_users from users)'
    .' or (parent_id != 0'
    .' and parent_id not in (select id from received_folder_subfolders))';
$mysqli->query($sql) || trigger_error($mysqli->error);
$deleted = $mysqli->affected_rows;

$ids = [];
$sql = "select data_json from deleted_items where data_type = 'receivedFolder'";
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) $ids[] = json_decode($row->data_json)->id;

$sql = 'select id, id_received_folders from received_folder_files'
    .' where id_received_folders not in (select id from received_folders)';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    if (!in_array($row->id_received_folders, $ids)) {
        $sql = "delete from received_folder_files where id = $row->id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
        $deleted++;
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $deleted row(s) deleted.\n";
