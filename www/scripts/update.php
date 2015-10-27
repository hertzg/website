#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

$sql = "select * from deleted_items where data_type = 'event'";
include_once '../fns/mysqli_query_object.php';
$items = mysqli_query_object($mysqli, $sql);

foreach ($items as $item) {
    $data_json = json_decode($item->data_json);
    $data_json->start_hour = $data_json->start_minute = null;
    $data_json = $mysqli->real_escape_string(json_encode($data_json));
    $sql = "update deleted_items set data_json = '$data_json'"
        ." where id = $item->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

echo "Done\n";
