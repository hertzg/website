#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../lib/cli.php';
include_once '../../lib/defaults.php';
include_once '../fns/mysqli_query_object.php';
include_once '../fns/mysqli_single_object.php';
include_once '../lib/mysqli.php';

$microtime = microtime(true);

$sql = 'select distinct id_bar_charts id from bar_chart_tags';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    $sql = "select * from bar_charts where id = $row->id";
    $bar_chart = mysqli_single_object($mysqli, $sql);
    if ($bar_chart) {
        include_once '../fns/BarChartTags/editBarChart.php';
        BarChartTags\editBarChart($mysqli,
            $bar_chart->id, $bar_chart->name, $bar_chart->tags,
            json_decode($bar_chart->tags_json), $bar_chart->insert_time,
            $bar_chart->update_time);
    }
}

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

$sql = 'select distinct id_calculations id from calculation_tags';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    $sql = "select * from calculations where id = $row->id";
    $calculation = mysqli_single_object($mysqli, $sql);
    if ($calculation) {
        include_once '../fns/CalculationTags/editCalculation.php';
        CalculationTags\editCalculation($mysqli, $calculation->id,
            $calculation->expression, $calculation->title,
            json_decode($calculation->tags_json), $calculation->value,
            $calculation->insert_time, $calculation->update_time);
    }
}

$sql = 'select distinct id_contacts id from contact_tags';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    $sql = "select * from contacts where id = $row->id";
    $contact = mysqli_single_object($mysqli, $sql);
    if ($contact) {
        include_once '../fns/ContactTags/editContact.php';
        ContactTags\editContact($mysqli,
            $contact->id, $contact->full_name, $contact->alias,
            $contact->email1, $contact->email1_label, $contact->email2,
            $contact->email2_label, $contact->phone1, $contact->phone1_label,
            $contact->phone2, $contact->phone2_label, $contact->favorite,
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
        NoteTags\editNote($mysqli, $note->id, $note->text,
            $note->encrypted_text, $note->encrypted_text_iv,
            $note->title, $note->encrypted_title, $note->encrypted_title_iv,
            $note->tags, json_decode($note->tags_json),
            $note->encrypt_in_listings, $note->password_protect,
            $note->insert_time, $note->update_time);
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
            $place->longitude, $place->name, $place->description,
            $place->tags, json_decode($place->tags_json),
            $place->insert_time, $place->update_time);
    }
}

$sql = 'select distinct id_schedules id from schedule_tags';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    $sql = "select * from schedules where id = $row->id";
    $schedule = mysqli_single_object($mysqli, $sql);
    if ($schedule) {
        include_once '../fns/ScheduleTags/editSchedule.php';
        ScheduleTags\editSchedule($mysqli, $schedule->id,
            $schedule->text, $schedule->interval, $schedule->offset,
            $schedule->insert_time, $schedule->update_time);
    }
}

$sql = 'select distinct id_tasks id from task_tags';
$rows = mysqli_query_object($mysqli, $sql);
foreach ($rows as $row) {
    $sql = "select * from tasks where id = $row->id";
    $task = mysqli_single_object($mysqli, $sql);
    if ($task) {
        include_once '../fns/TaskTags/editTask.php';
        TaskTags\editTask($mysqli, $task->id, $task->text,
            $task->title, $task->deadline_time, $task->tags,
            json_decode($task->tags_json), $task->top_priority,
            $task->insert_time, $task->update_time);
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
