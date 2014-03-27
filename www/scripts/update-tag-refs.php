#!/usr/bin/php
<?php

chdir(__DIR__);
include_once 'lib/require-cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'select distinct idbookmarks value from bookmark_tags';
$ids = mysqli_query_object($mysqli, $sql);
foreach ($ids as $id) {
    $sql = "select * from bookmarks where idbookmarks = $id->value";
    $bookmark = mysqli_single_object($mysqli, $sql);
    if ($bookmark) {
        $title = $mysqli->real_escape_string($bookmark->title);
        $url = $mysqli->real_escape_string($bookmark->url);
        $sql = 'update bookmark_tags set'
            ." title = '$title',"
            ." url = '$url',"
            ." insert_time = $bookmark->insert_time,"
            ." update_time = $bookmark->update_time"
            ." where idbookmarks = $bookmark->idbookmarks";
        $mysqli->query($sql);
    }
}

$sql = 'select distinct idnotes value from note_tags';
$ids = mysqli_query_object($mysqli, $sql);
foreach ($ids as $id) {
    $sql = "select * from notes where idnotes = $id->value";
    $note = mysqli_single_object($mysqli, $sql);
    if ($note) {
        $notetext = $mysqli->real_escape_string($note->notetext);
        $sql = 'update note_tags set'
            ." notetext = '$notetext',"
            ." insert_time = $note->insert_time,"
            ." update_time = $note->update_time"
            ." where idnotes = $note->idnotes";
        $mysqli->query($sql);
    }
}

$sql = 'select distinct idtasks value from task_tags';
$ids = mysqli_query_object($mysqli, $sql);
foreach ($ids as $id) {
    $sql = "select * from tasks where idtasks = $id->value";
    $task = mysqli_single_object($mysqli, $sql);
    if ($task) {
        $tasktext = $mysqli->real_escape_string($task->tasktext);
        $sql = 'update task_tags set'
            ." tasktext = '$tasktext',"
            ." top_priority = $task->top_priority,"
            ." insert_time = $task->insert_time,"
            ." update_time = $task->update_time"
            ." where idtasks = $task->idtasks";
        $mysqli->query($sql);
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
