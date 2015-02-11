#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'select distinct id_bookmarks id from bookmark_tags';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    $sql = "select * from bookmarks where id = $row->id";
    $bookmark = mysqli_single_object($mysqli, $sql);
    if ($bookmark) {
        include_once '../fns/BookmarkTags/editBookmark.php';
        BookmarkTags\editBookmark($mysqli, $bookmark->id, $bookmark->url,
            $bookmark->title, $bookmark->insert_time, $bookmark->update_time);
    }
}

$sql = 'select distinct id_contacts id from contact_tags';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    $sql = "select * from contacts where id = $row->id";
    $contact = mysqli_single_object($mysqli, $sql);
    if ($contact) {
        include_once '../fns/ContactTags/editContact.php';
        ContactTags\editContact($mysqli, $contact->id,
            $contact->full_name, $contact->alias, $contact->email,
            $contact->phone1, $contact->phone2, $contact->favorite,
            $contact->insert_time, $contact->update_time);
    }
}

$sql = 'select distinct id_notes id from note_tags';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    $sql = "select * from notes where id = $row->id";
    $note = mysqli_single_object($mysqli, $sql);
    if ($note) {
        include_once '../fns/NoteTags/editNote.php';
        NoteTags\editNote($mysqli, $note->id, $note->text, $note->tags,
            $note->encrypt, $note->insert_time, $note->update_time);
    }
}

$sql = 'select distinct id_places id from place_tags';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    $sql = "select * from places where id = $row->id";
    $place = mysqli_single_object($mysqli, $sql);
    if ($place) {
        include_once '../fns/PlaceTags/editPlace.php';
        PlaceTags\editPlace($mysqli, $place->id, $place->latitude,
            $place->longitude, $place->name, $place->tags,
            $place->insert_time, $place->update_time);
    }
}

$sql = 'select distinct id_tasks id from task_tags';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    $sql = "select * from tasks where id = $row->id";
    $task = mysqli_single_object($mysqli, $sql);
    if ($task) {
        include_once '../fns/TaskTags/editTask.php';
        TaskTags\editTask($mysqli, $task->id, $task->text, $task->tags,
            $task->top_priority, $task->insert_time, $task->update_time);
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
