#!/usr/bin/php
<?php

function process ($mysqli, $type, $equals_time) {

    $sql = "select * from deleted_items where data_type = '$type'";
    $rows = mysqli_query_object($mysqli, $sql);

    foreach ($rows as $row) {
        $data_json = json_decode($row->data_json);
        if (!property_exists($data_json, 'revision')) {
            if ($equals_time($data_json)) $revision = 0;
            else $revision = 1;
            $data_json->revision = $revision;
            $data_json = json_encode($data_json);
            $data_json = $mysqli->real_escape_string($data_json);
            $sql = "update deleted_items set data_json = '$data_json'"
                ." where id = $row->id";
            $mysqli->query($sql) || trigger_error($mysqli->error);
        }
    }

}

function equals_update_time ($a) {
    return $a->insert_time == $a->update_time;
}

function equals_rename_time ($a) {
    return $a->insert_time == $a->rename_time;
}

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

process($mysqli, 'bookmark', 'equals_update_time');
process($mysqli, 'contact', 'equals_update_time');
process($mysqli, 'file', 'equals_rename_time');
process($mysqli, 'folder', 'equals_rename_time');
process($mysqli, 'note', 'equals_update_time');
process($mysqli, 'task', 'equals_update_time');

$sql = "select * from deleted_items where data_type = 'file'";
$rows = mysqli_query_object($mysqli, $sql);

foreach ($rows as $row) {
    $data_json = json_decode($row->data_json);
    if (!property_exists($data_json, 'content_revision')) {
        $data_json->content_revision = 0;
        $data_json = json_encode($data_json);
        $data_json = $mysqli->real_escape_string($data_json);
        $sql = "update deleted_items set data_json = '$data_json'"
            ." where id = $row->id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
