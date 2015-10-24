#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

$sql = 'update deleted_files set hashes_computed = 1';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'update files set hashes_computed = 1';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'update received_files set hashes_computed = 1';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'update received_folder_files set hashes_computed = 1';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'select * from deleted_items'
    ." where data_type in ('file', 'receivedFile')";
include_once '../fns/mysqli_query_object.php';
$items = mysqli_query_object($mysqli, $sql);

foreach ($items as $item) {
    $data_json = json_decode($item->data_json);
    $data_json->hashes_computed = '1';
    $data_json = $mysqli->real_escape_string(json_encode($data_json));
    $sql = "update deleted_items set data_json = '$data_json'"
        ." where id = $item->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

echo "Done\n";
