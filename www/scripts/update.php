#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../lib/mysqli.php';

$sql = 'alter table notes change encrypt'
    .' encrypt_in_listings tinyint unsigned not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table note_tags change encrypt'
    .' encrypt_in_listings tinyint unsigned not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table received_notes change encrypt'
    .' encrypt_in_listings tinyint unsigned not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'select * from deleted_items'
    ." where data_type in ('note', 'received_note')";
include_once '../fns/mysqli_query_object.php';
$deleted_items = mysqli_query_object($mysqli, $sql);

foreach ($deleted_items as $deleted_item) {
    $data = json_decode($deleted_item->data_json);
    $data->encrypt_in_listings = $data->encrypt;
    unset($data->encrypt);
    $data = $mysqli->real_escape_string(json_encode($data));
    $sql = "update deleted_items set data_json = '$data'"
        ." where id = $deleted_item->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

echo "Done\n";
