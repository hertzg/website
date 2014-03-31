#!/usr/bin/php
<?php

chdir(__DIR__);
include_once 'lib/require-cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'select distinct id_bookmarks value from bookmark_tags';
$ids = mysqli_query_object($mysqli, $sql);
foreach ($ids as $id) {
    $sql = "select * from bookmarks where id_bookmarks = $id->value";
    $bookmark = mysqli_single_object($mysqli, $sql);
    if ($bookmark) {
        $title = $mysqli->real_escape_string($bookmark->title);
        $url = $mysqli->real_escape_string($bookmark->url);
        $sql = 'update bookmark_tags set'
            ." title = '$title',"
            ." url = '$url',"
            ." insert_time = $bookmark->insert_time,"
            ." update_time = $bookmark->update_time"
            ." where id_bookmarks = $bookmark->id_bookmarks";
        $mysqli->query($sql);
    }
}

$sql = 'select distinct id_notes value from note_tags';
$ids = mysqli_query_object($mysqli, $sql);
foreach ($ids as $id) {
    $sql = "select * from notes where id_notes = $id->value";
    $note = mysqli_single_object($mysqli, $sql);
    if ($note) {
        $note_text = $mysqli->real_escape_string($note->note_text);
        $sql = 'update note_tags set'
            ." note_text = '$note_text',"
            ." insert_time = $note->insert_time,"
            ." update_time = $note->update_time"
            ." where id_notes = $note->id_notes";
        $mysqli->query($sql);
    }
}

$sql = 'select distinct id_tasks value from task_tags';
$ids = mysqli_query_object($mysqli, $sql);
foreach ($ids as $id) {
    $sql = "select * from tasks where id_tasks = $id->value";
    $task = mysqli_single_object($mysqli, $sql);
    if ($task) {
        $task_text = $mysqli->real_escape_string($task->task_text);
        $sql = 'update task_tags set'
            ." task_text = '$task_text',"
            ." top_priority = $task->top_priority,"
            ." insert_time = $task->insert_time,"
            ." update_time = $task->update_time"
            ." where id_tasks = $task->id_tasks";
        $mysqli->query($sql);
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
