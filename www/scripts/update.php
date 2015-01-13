#!/usr/bin/php
<?php

function process ($mysqli, $type) {

    $sql = "select * from deleted_items where data_type = '$type'";
    $rows = mysqli_query_object($mysqli, $sql);

    foreach ($rows as $row) {
        $data_json = json_decode($row->data_json);
        if (!property_exists($data_json, 'revision')) {
            if ($data_json->insert_time == $data_json->update_time) {
                $revision = 0;
            } else {
                $revision = 1;
            }
            $data_json->revision = $revision;
            $data_json = json_encode($data_json);
            $data_json = $mysqli->real_escape_string($data_json);
            $sql = "update deleted_items set data_json = '$data_json'"
                ." where id = $row->id";
            $mysqli->query($sql) || trigger_error($mysqli->error);
        }
    }

}

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

process($mysqli, 'bookmark');
process($mysqli, 'contact');
process($mysqli, 'note');
process($mysqli, 'task');

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
