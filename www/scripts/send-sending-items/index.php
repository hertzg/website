#!/usr/bin/php
<?php

chdir(__DIR__);
include_once '../../../lib/cli.php';
include_once '../../../lib/defaults.php';
include_once '../../fns/mysqli_query_object.php';
include_once '../../lib/mysqli.php';
include_once 'fns/call_exchange_api_method.php';

$microtime = microtime(true);

include_once '../../fns/SendingBookmarks/index.php';
$sending_bookmarks = SendingBookmarks\index($mysqli);

if ($sending_bookmarks) {
    include_once '../../fns/SendingBookmarks/delete.php';
    include_once '../../fns/SendingBookmarks/increaseNumFails.php';
    foreach ($sending_bookmarks as $sending_bookmark) {
        $params = [
            'exchange_api_key' => $sending_bookmark->their_exchange_api_key,
            'sender_username' => $sending_bookmark->sender_username,
            'receiver_username' => $sending_bookmark->receiver_username,
            'url' => $sending_bookmark->url,
            'title' => $sending_bookmark->title,
            'tags' => $sending_bookmark->tags,
        ];
        $ok = call_exchange_api_method('receiveBookmark',
            $sending_bookmark->receiver_address, $params);
        if ($ok === false) {
            SendingBookmarks\increaseNumFails($mysqli, $sending_bookmark->id);
        } else {
            SendingBookmarks\delete($mysqli, $sending_bookmark->id);
        }
    }
}

include_once '../../fns/SendingCalculations/index.php';
$sending_calculations = SendingCalculations\index($mysqli);

if ($sending_calculations) {
    include_once '../../fns/SendingCalculations/delete.php';
    include_once '../../fns/SendingCalculations/increaseNumFails.php';
    foreach ($sending_calculations as $sending_calculation) {
        $params = [
            'exchange_api_key' => $sending_calculation->their_exchange_api_key,
            'sender_username' => $sending_calculation->sender_username,
            'receiver_username' => $sending_calculation->receiver_username,
            'expression' => $sending_calculation->expression,
            'title' => $sending_calculation->title,
            'tags' => $sending_calculation->tags,
        ];
        $ok = call_exchange_api_method('receiveCalculation',
            $sending_calculation->receiver_address, $params);
        if ($ok === false) {
            SendingCalculations\increaseNumFails(
                $mysqli, $sending_calculation->id);
        } else {
            SendingCalculations\delete($mysqli, $sending_calculation->id);
        }
    }
}

include_once '../../fns/SendingContacts/index.php';
$sending_contacts = SendingContacts\index($mysqli);

if ($sending_contacts) {
    include_once '../../fns/SendingContacts/delete.php';
    include_once '../../fns/SendingContacts/increaseNumFails.php';
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
        $ok = call_exchange_api_method('receiveContact',
            $sending_contact->receiver_address, $params);
        if ($ok === false) {
            SendingContacts\increaseNumFails($mysqli, $sending_contact->id);
        } else {
            SendingContacts\delete($mysqli, $sending_contact->id);
        }
    }
}

include_once '../../fns/SendingNotes/index.php';
$sending_notes = SendingNotes\index($mysqli);

if ($sending_notes) {
    include_once '../../fns/SendingNotes/delete.php';
    include_once '../../fns/SendingNotes/increaseNumFails.php';
    foreach ($sending_notes as $sending_note) {
        $params = [
            'exchange_api_key' => $sending_note->their_exchange_api_key,
            'sender_username' => $sending_note->sender_username,
            'receiver_username' => $sending_note->receiver_username,
            'text' => $sending_note->text,
            'tags' => $sending_note->tags,
            'encrypt_in_listings' => $sending_note->encrypt_in_listings,
        ];
        $ok = call_exchange_api_method('receiveNote',
            $sending_note->receiver_address, $params);
        if ($ok === false) {
            SendingNotes\increaseNumFails($mysqli, $sending_note->id);
        } else {
            SendingNotes\delete($mysqli, $sending_note->id);
        }
    }
}

include_once '../../fns/SendingPlaces/index.php';
$sending_places = SendingPlaces\index($mysqli);

if ($sending_places) {
    include_once '../../fns/SendingPlaces/delete.php';
    include_once '../../fns/SendingPlaces/increaseNumFails.php';
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
        $ok = call_exchange_api_method('receivePlace',
            $sending_place->receiver_address, $params);
        if ($ok === false) {
            SendingPlaces\increaseNumFails($mysqli, $sending_place->id);
        } else {
            SendingPlaces\delete($mysqli, $sending_place->id);
        }
    }
}

include_once '../../fns/SendingSchedules/index.php';
$sending_schedules = SendingSchedules\index($mysqli);

if ($sending_schedules) {
    include_once '../../fns/SendingSchedules/delete.php';
    include_once '../../fns/SendingSchedules/increaseNumFails.php';
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
        $ok = call_exchange_api_method('receiveSchedule',
            $sending_schedule->receiver_address, $params);
        if ($ok === false) {
            SendingSchedules\increaseNumFails($mysqli, $sending_schedule->id);
        } else {
            SendingSchedules\delete($mysqli, $sending_schedule->id);
        }
    }
}

$sql = 'select * from sending_tasks order by insert_time';
$sending_tasks = mysqli_query_object($mysqli, $sql);

if ($sending_tasks) {
    include_once '../../fns/SendingTasks/delete.php';
    include_once '../../fns/SendingTasks/increaseNumFails.php';
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
        $ok = call_exchange_api_method('receiveTask',
            $sending_task->receiver_address, $params);
        if ($ok === false) {
            SendingTasks\increaseNumFails($mysqli, $sending_task->id);
        } else {
            SendingTasks\delete($mysqli, $sending_task->id);
        }
    }
}

$elapsedSeconds = number_format(microtime(true) - $microtime, 3);
echo "Done in $elapsedSeconds seconds.\n";
