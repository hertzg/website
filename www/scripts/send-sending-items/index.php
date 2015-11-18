#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/cli.php';
include_once '../../fns/mysqli_query_object.php';
include_once '../../lib/mysqli.php';
include_once 'fns/call_exchange_api_method.php';

$microtime = microtime(true);

$sql = 'select * from sending_bookmarks order by insert_time';
$sending_bookmarks = mysqli_query_object($mysqli, $sql);

if ($sending_bookmarks) {
    include_once '../../fns/SendingBookmarks/delete.php';
    foreach ($sending_bookmarks as $sending_bookmark) {
        $params = [
            'exchange_api_key' => $sending_bookmark->their_exchange_api_key,
            'sender_username' => $sending_bookmark->sender_username,
            'receiver_username' => $sending_bookmark->receiver_username,
            'url' => $sending_bookmark->url,
            'title' => $sending_bookmark->title,
            'tags' => $sending_bookmark->tags,
        ];
        call_exchange_api_method('receiveBookmark',
            $sending_bookmark->receiver_address, $params);
        SendingBookmarks\delete($mysqli, $sending_bookmark->id);
    }
}

$sql = 'select * from sending_contacts order by insert_time';
$sending_contacts = mysqli_query_object($mysqli, $sql);

if ($sending_contacts) {
    include_once '../../fns/SendingContacts/delete.php';
    foreach ($sending_contacts as $sending_contact) {
        $params = [
            'exchange_api_key' => $sending_contact->their_exchange_api_key,
            'sender_username' => $sending_contact->sender_username,
            'receiver_username' => $sending_contact->receiver_username,
            'full_name' => $sending_contact->full_name,
            'address' => $sending_contact->address,
            'email1' => $sending_contact->email1,
            'email1_label' => $sending_contact->email1_label,
            'email2' => $sending_contact->email2,
            'email2_label' => $sending_contact->email2_label,
            'phone1' => $sending_contact->phone1,
            'phone1_label' => $sending_contact->phone1_label,
            'phone2' => $sending_contact->phone2,
            'phone2_label' => $sending_contact->phone2_label,
            'birthday_time' => $sending_contact->birthday_time,
            'username' => $sending_contact->username,
            'timezone' => $sending_contact->timezone,
            'tags' => $sending_contact->tags,
            'notes' => $sending_contact->notes,
            'favorite' => $sending_contact->favorite,
        ];
        call_exchange_api_method('receiveContact',
            $sending_contact->receiver_address, $params);
        SendingContacts\delete($mysqli, $sending_contact->id);
    }
}

$sql = 'select * from sending_notes order by insert_time';
$sending_notes = mysqli_query_object($mysqli, $sql);

if ($sending_notes) {
    include_once '../../fns/SendingNotes/delete.php';
    foreach ($sending_notes as $sending_note) {
        $params = [
            'exchange_api_key' => $sending_note->their_exchange_api_key,
            'sender_username' => $sending_note->sender_username,
            'receiver_username' => $sending_note->receiver_username,
            'text' => $sending_note->text,
            'tags' => $sending_note->tags,
            'encrypt_in_listings' => $sending_note->encrypt_in_listings,
        ];
        call_exchange_api_method('receiveNote',
            $sending_note->receiver_address, $params);
        SendingNotes\delete($mysqli, $sending_note->id);
    }
}

$sql = 'select * from sending_places order by insert_time';
$sending_places = mysqli_query_object($mysqli, $sql);

if ($sending_places) {
    include_once '../../fns/SendingPlaces/delete.php';
    foreach ($sending_places as $sending_place) {
        $params = [
            'exchange_api_key' => $sending_place->their_exchange_api_key,
            'sender_username' => $sending_place->sender_username,
            'receiver_username' => $sending_place->receiver_username,
            'latitude' => $sending_place->latitude,
            'longitude' => $sending_place->longitude,
            'altitude' => $sending_place->altitude,
            'name' => $sending_place->name,
            'description' => $sending_place->description,
            'tags' => $sending_place->tags,
        ];
        call_exchange_api_method('receivePlace',
            $sending_place->receiver_address, $params);
        SendingPlaces\delete($mysqli, $sending_place->id);
    }
}

$sql = 'select * from sending_schedules order by insert_time';
$sending_schedules = mysqli_query_object($mysqli, $sql);

if ($sending_schedules) {
    include_once '../../fns/SendingSchedules/delete.php';
    foreach ($sending_schedules as $sending_schedule) {
        $params = [
            'exchange_api_key' => $sending_schedule->their_exchange_api_key,
            'sender_username' => $sending_schedule->sender_username,
            'receiver_username' => $sending_schedule->receiver_username,
            'text' => $sending_schedule->text,
            'interval' => $sending_schedule->interval,
            'offset' => $sending_schedule->offset,
            'tags' => $sending_schedule->tags,
        ];
        call_exchange_api_method('receiveSchedule',
            $sending_schedule->receiver_address, $params);
        SendingSchedules\delete($mysqli, $sending_schedule->id);
    }
}

$sql = 'select * from sending_tasks order by insert_time';
$sending_tasks = mysqli_query_object($mysqli, $sql);

if ($sending_tasks) {
    include_once '../../fns/SendingTasks/delete.php';
    foreach ($sending_tasks as $sending_task) {
        $params = [
            'exchange_api_key' => $sending_task->their_exchange_api_key,
            'sender_username' => $sending_task->sender_username,
            'receiver_username' => $sending_task->receiver_username,
            'text' => $sending_task->text,
            'deadline_time' => $sending_task->deadline_time,
            'tags' => $sending_task->tags,
            'top_priority' => $sending_task->top_priority,
        ];
        call_exchange_api_method('receiveTask',
            $sending_task->receiver_address, $params);
        SendingTasks\delete($mysqli, $sending_task->id);
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
