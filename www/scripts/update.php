<?php

chdir(__DIR__);
include_once '../lib/mysqli.php';

$sql = 'alter table tasks add deadline_time bigint unsigned first';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table received_tasks add deadline_time bigint unsigned after archived';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = "select * from deleted_items where data_type in ('task', 'receivedTask')";
include_once '../fns/mysqli_query_object.php';
$items = mysqli_query_object($mysqli, $sql);
foreach ($items as $item) {
    $data = json_decode($item->data_json);
    $data->deadline_time = null;
    $data = json_encode($data);
    $data = $mysqli->real_escape_string($data);
    $sql = "update deleted_items set data_json = '$data' where id = $item->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

echo "Done\n";
