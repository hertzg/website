#!/usr/bin/php
<?php

function delete ($mysqli, $id, &$deleted) {
    $sql = "delete from received_folder_subfolders where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
    $deleted++;
}

chdir(__DIR__);
include_once '../../../lib/cli.php';
include_once '../../../lib/defaults.php';
include_once '../../lib/mysqli.php';
include_once '../../fns/mysqli_query_object.php';

$microtime = microtime(true);

$sql = 'delete from received_folder_subfolders'
    .' where id_users not in (select id_users from users)';
$mysqli->query($sql) || trigger_error($mysqli->error);
$deleted = $mysqli->affected_rows;

$sql = 'select id from received_folder_subfolders where parent_id != 0'
    .' and parent_id not in (select id from received_folder_subfolders)';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) delete($mysqli, $row->id, $deleted);

$ids = [];
$sql = "select data_json from deleted_items where data_type = 'receivedFolder'";
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) $ids[] = json_decode($row->data_json)->id;

$sql = 'select id, id_received_folders from received_folder_subfolders'
    .' where id_received_folders not in (select id from received_folders)';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    if (!in_array($row->id_received_folders, $ids)) {
        delete($mysqli, $row->id, $deleted);
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $deleted row(s) deleted.\n";
