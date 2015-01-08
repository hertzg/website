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
$maxLengths = Notes\maxLengths();
process($mysqli, 'notes', $maxLengths);
process($mysqli, 'note_tags', $maxLengths);
process($mysqli, 'received_notes', $maxLengths);

include_once '../fns/Tasks/maxLengths.php';
$maxLengths = Tasks\maxLengths();
process($mysqli, 'tasks', $maxLengths);
process($mysqli, 'task_tags', $maxLengths);
process($mysqli, 'received_tasks', $maxLengths);

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
