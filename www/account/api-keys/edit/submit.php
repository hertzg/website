<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $user) = require_api_key($mysqli);

include_once '../fns/request_api_key_params.php';
list($name, $expires, $expire_time, $bookmark_access,
    $channel_access, $contact_access, $event_access,
    $file_access, $note_access, $notification_access, $place_access,
    $schedule_access, $task_access, $wallet_access) = request_api_key_params();

include_once "$fnsDir/request_strings.php";
list($randomizeKey) = request_strings('randomizeKey');

$randomizeKey = (bool)$randomizeKey;

$errors = [];

if ($name === '') $errors[] = 'Enter name.';
else {
    include_once "$fnsDir/ApiKeys/getOnUserByName.php";
    $existingApiKey = ApiKeys\getOnUserByName(
        $mysqli, $user->id_users, $name, $id);
    if ($existingApiKey) {
        $errors[] = 'An API key with the same name already exists.';
    }
}

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['account/api-keys/edit/errors'] = $errors;
    $_SESSION['account/api-keys/edit/values'] = [
        'name' => $name,
        'expires' => $expires,
        'randomizeKey' => $randomizeKey,
        'bookmark_access' => $bookmark_access,
        'channel_access' => $channel_access,
        'contact_access' => $contact_access,
        'event_access' => $event_access,
        'file_access' => $file_access,
        'note_access' => $note_access,
        'notification_access' => $notification_access,
        'place_access' => $place_access,
        'schedule_access' => $schedule_access,
        'task_access' => $task_access,
        'wallet_access' => $wallet_access,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['account/api-keys/edit/errors'],
    $_SESSION['account/api-keys/edit/values']
);

include_once '../fns/parse_read_write.php';
parse_read_write($bookmark_access, $can_read_bookmarks, $can_write_bookmarks);
parse_read_write($channel_access, $can_read_channels, $can_write_channels);
parse_read_write($contact_access, $can_read_contacts, $can_write_contacts);
parse_read_write($event_access, $can_read_events, $can_write_events);
parse_read_write($file_access, $can_read_files, $can_write_files);
parse_read_write($note_access, $can_read_notes, $can_write_notes);
parse_read_write($notification_access,
    $can_read_notifications, $can_write_notifications);
parse_read_write($place_access, $can_read_places, $can_write_places);
parse_read_write($schedule_access, $can_read_schedules, $can_write_schedules);
parse_read_write($task_access, $can_read_tasks, $can_write_tasks);
parse_read_write($wallet_access, $can_read_wallets, $can_write_wallets);

include_once "$fnsDir/Users/ApiKeys/edit.php";
Users\ApiKeys\edit($mysqli, $apiKey, $name, $expire_time, $can_read_bookmarks,
    $can_read_channels, $can_read_contacts, $can_read_events, $can_read_files,
    $can_read_notes, $can_read_notifications, $can_read_places,
    $can_read_schedules, $can_read_tasks, $can_read_wallets,
    $can_write_bookmarks, $can_write_channels, $can_write_contacts,
    $can_write_events, $can_write_files, $can_write_notes,
    $can_write_notifications, $can_write_places, $can_write_schedules,
    $can_write_tasks, $can_write_wallets);

if ($randomizeKey) {
    include_once "$fnsDir/ApiKeys/randomizeKey.php";
    ApiKeys\randomizeKey($mysqli, $id);
}

$_SESSION['account/api-keys/view/messages'] = ['Changes have been saved.'];

redirect("../view/?id=$id");
