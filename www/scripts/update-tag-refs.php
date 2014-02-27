#!/usr/bin/php
<?php

include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'select distinct idbookmarks value from bookmarktags';
$ids = mysqli_query_object($mysqli, $sql);
foreach ($ids as $id) {
    $sql = "select * from bookmarks where idbookmarks = $id->value";
    $bookmark = mysqli_single_object($mysqli, $sql);
    if ($bookmark) {
        $title = $mysqli->real_escape_string($bookmark->title);
        $url = $mysqli->real_escape_string($bookmark->url);
        $sql = 'update bookmarktags set'
            ." title = '$title',"
            ." url = '$url',"
            ." inserttime = $bookmark->inserttime,"
            ." updatetime = $bookmark->updatetime"
            ." where idbookmarks = $bookmark->idbookmarks";
        $mysqli->query($sql);
    }
}

$sql = 'select distinct idnotes value from notetags';
$ids = mysqli_query_object($mysqli, $sql);
foreach ($ids as $id) {
    $sql = "select * from notes where idnotes = $id->value";
    $note = mysqli_single_object($mysqli, $sql);
    if ($note) {
        $notetext = $mysqli->real_escape_string($note->notetext);
        $sql = 'update notetags set'
            ." notetext = '$notetext',"
            ." inserttime = $note->inserttime,"
            ." updatetime = $note->updatetime"
            ." where idnotes = $note->idnotes";
        $mysqli->query($sql);
    }
}

$sql = 'select distinct idtasks value from tasktags';
$ids = mysqli_query_object($mysqli, $sql);
foreach ($ids as $id) {
    $sql = "select * from tasks where idtasks = $id->value";
    $task = mysqli_single_object($mysqli, $sql);
    if ($task) {
        $tasktext = $mysqli->real_escape_string($task->tasktext);
        $sql = 'update tasktags set'
            ." tasktext = '$tasktext',"
            ." top_priority = $task->top_priority,"
            ." inserttime = $task->inserttime,"
            ." updatetime = $task->updatetime"
            ." where idtasks = $task->idtasks";
        $mysqli->query($sql);
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
