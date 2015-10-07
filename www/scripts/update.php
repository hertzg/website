#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

include_once '../fns/Table/ensureAll.php';
Table\ensureAll($mysqli);

$sql = 'select * from deleted_items'
    ." where data_type in ('contact', 'receivedContact')";
$items = mysqli_query_object($mysqli, $sql);
foreach ($items as $item) {
    $data_json = json_decode($item->data_json);
    $data_json->phone1_label = $data_json->phone2_label = '';
    $data_json = $mysqli->real_escape_string(json_encode($data_json));
    $sql = 'update deleted_items'
        ." set data_json = '$data_json' where id = $item->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

echo "Done\n";
