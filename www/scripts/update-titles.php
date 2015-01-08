#!/usr/bin/php
<?php

function process ($mysqli, $table, $maxLengths) {
    $rows = mysqli_query_object($mysqli, "select * from $table");
    foreach ($rows as $row) {
        $title = text_title($row->text, $maxLengths['title']);
        $title = $mysqli->real_escape_string($title);
        $sql = "update $table set title = '$title' where id = $row->id";
        $mysqli->query($sql) || trigger_error($mysqli->error);
    }
}

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/text_title.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

include_once '../fns/Notes/maxLengths.php';
process($mysqli, 'notes', Notes\maxLengths());

include_once '../fns/Tasks/maxLengths.php';
process($mysqli, 'tasks', Tasks\maxLengths());

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
