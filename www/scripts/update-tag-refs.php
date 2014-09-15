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
            ." title = '$title', url = '$url',"
            ." insert_time = $bookmark->insert_time,"
            ." update_time = $bookmark->update_time"
            ." where id_bookmarks = $bookmark->id_bookmarks";

        $mysqli->query($sql) || trigger_error($mysqli->error);

    }
}

$sql = 'select distinct id_contacts value from contact_tags';
$ids = mysqli_query_object($mysqli, $sql);
foreach ($ids as $id) {
    $sql = "select * from contacts where id_contacts = $id->value";
    $contact = mysqli_single_object($mysqli, $sql);
    if ($contact) {

        $full_name = $mysqli->real_escape_string($contact->full_name);
        $alias = $mysqli->real_escape_string($contact->alias);
        $phone1 = $mysqli->real_escape_string($contact->phone1);
        $phone2 = $mysqli->real_escape_string($contact->phone2);
        $favorite = $contact->favorite ? '1' : '0';

        $sql = 'update contact_tags set'
            ." full_name = '$full_name', alias = '$alias',"
            ." phone1 = $phone1, phone2 = $phone2,"
            ." favorite = $favorite, insert_time = $contact->insert_time,"
            ." update_time = $contact->update_time"
            ." where id_contacts = $contact->id_contacts";

        $mysqli->query($sql) || trigger_error($mysqli->error);

    }
}

$sql = 'select distinct id_notes value from note_tags';
$ids = mysqli_query_object($mysqli, $sql);
foreach ($ids as $id) {
    $sql = "select * from notes where id_notes = $id->value";
    $note = mysqli_single_object($mysqli, $sql);
    if ($note) {

        $text = $mysqli->real_escape_string($note->text);
        $encrypt = $note->encrypt ? '1' : '0';

        $sql = "update note_tags set text = '$text', encrypt = $encrypt,"
            ." insert_time = $note->insert_time,"
            ." update_time = $note->update_time"
            ." where id_notes = $note->id_notes";

        $mysqli->query($sql) || trigger_error($mysqli->error);

    }
}

$sql = 'select distinct id_tasks value from task_tags';
$ids = mysqli_query_object($mysqli, $sql);
foreach ($ids as $id) {
    $sql = "select * from tasks where id_tasks = $id->value";
    $task = mysqli_single_object($mysqli, $sql);
    if ($task) {

        $text = $mysqli->real_escape_string($task->text);

        $sql = "update task_tags set text = '$text',"
            ." top_priority = $task->top_priority,"
            ." insert_time = $task->insert_time,"
            ." update_time = $task->update_time"
            ." where id_tasks = $task->id_tasks";

        $mysqli->query($sql) || trigger_error($mysqli->error);

    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
