#!/usr/bin/php
<?php

function process ($mysqli, $table, $length) {
    $rows = mysqli_query_object($mysqli, "select * from $table");
    foreach ($rows as $row) {
        $title = text_title($row->text, $length);
        $title = $mysqli->real_escape_string($title);
        $sql = "update $table set title = '$title' where id = $row->id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }
}

function process_deleted ($mysqli, $types, $length) {

    $types = array_map(function ($type) {
        return "'$type'";
    }, $types);

    $sql = 'select * from deleted_items'
        .' where data_type in ('.join(',', $types).')';
    $rows = mysqli_query_object($mysqli, $sql);

    foreach ($rows as $row) {
        $data_json = json_decode($row->data_json);
        $title = text_title($data_json->text, $length);
        $data_json = json_encode($data_json);
        $data_json = $mysqli->real_escape_string($data_json);
        $sql = "update deleted_items set data_json = '$data_json'"
            ." where id = $row->id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }

}

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/text_title.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

include_once '../fns/Notes/maxLengths.php';
$length = Notes\maxLengths()['title'];
process($mysqli, 'notes', $length);
process($mysqli, 'note_tags', $length);
process($mysqli, 'received_notes', $length);
process_deleted($mysqli, ['note', 'receivedNote'], $length);

include_once '../fns/Tasks/maxLengths.php';
$length = Tasks\maxLengths()['title'];
process($mysqli, 'tasks', $length);
process($mysqli, 'task_tags', $length);
process($mysqli, 'received_tasks', $length);
process_deleted($mysqli, ['task', 'receivedTask'], $length);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
