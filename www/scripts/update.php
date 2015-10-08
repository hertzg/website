#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$sql = 'alter table contacts change email'
    .' email1 varchar(64) character set utf8 collate utf8_general_ci not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table contact_tags change email'
    .' email1 varchar(64) character set utf8 collate utf8_general_ci not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

$sql = 'alter table received_contacts change email'
    .' email1 varchar(64) character set utf8 collate utf8_general_ci not null';
$mysqli->query($sql) || trigger_error($mysqli->error);

include_once '../fns/Table/ensureAll.php';
echo Table\ensureAll($mysqli);

$sql = 'select * from deleted_items'
    ." where data_type in ('contact', 'receivedContact')";
$items = mysqli_query_object($mysqli, $sql);
foreach ($items as $item) {
    $data_json = json_decode($item->data_json);
    $data_json->email1 = $data_json->email;
    unset($data_json->email);
    $data_json->email2 = '';
    $data_json = $mysqli->real_escape_string(json_encode($data_json));
    $sql = 'update deleted_items set'
        ." data_json = '$data_json' where id = $item->id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}

echo "Done\n";
