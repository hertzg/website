#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../../lib/cli.php';
include_once '../../../../lib/defaults.php';
include_once '../../../lib/mysqli.php';
include_once '../../../fns/mysqli_query_object.php';

$microtime = microtime(true);

$sql = 'delete from deleted_files'
    .' where id_deleted_items not in (select id from deleted_items)'
    .' or id_users not in (select id_users from users)';
$mysqli->query($sql) || trigger_error($mysqli->error);

$deleted = $mysqli->affected_rows;

$ids = [];
$sql = "select data_json from deleted_items where data_type = 'folder'";
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) $ids[] = json_decode($row->data_json)->id;

$sql = 'select * from deleted_files'
    .' where id_folders not in (select id_folders from deleted_folders)';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    if (!in_array($row->id_folders, $ids)) {
        $sql = "delete from deleted_files where id_files = $row->id_files";
        $mysqli->query($sql) || trigger_error($mysqli->error);
        $deleted++;
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n"
    ." $deleted row(s) deleted.\n";
