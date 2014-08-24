<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../fns/require_user.php';
$user = require_user('../../../');
$id_users = $user->id_users;

include_once '../fns/request_api_key_params.php';
list($name, $expires, $expire_time, $bookmark_access,
    $channel_access, $contact_access, $event_access,
    $file_access, $note_access, $notification_access,
    $schedule_access, $task_access) = request_api_key_params();

$errors = [];

if ($name === '') $errors[] = 'Enter name.';
else {
    include_once '../../../fns/ApiKeys/getOnUserByName.php';
    include_once '../../../lib/mysqli.php';
    $apiKey = ApiKeys\getOnUserByName($mysqli, $id_users, $name);
    if ($apiKey) {
        $errors[] = 'An API key with this name already exists.';
    }
}

include_once '../../../fns/redirect.php';

if ($errors) {
    $_SESSION['account/api-keys/new/errors'] = $errors;
    $_SESSION['account/api-keys/new/values'] = [
        'name' => $name,
        'expires' => $expires,
        'bookmark_access' => $bookmark_access,
        'channel_access' => $channel_access,
        'contact_access' => $contact_access,
        'event_access' => $event_access,
        'file_access' => $file_access,
        'note_access' => $note_access,
        'notification_access' => $notification_access,
        'schedule_access' => $schedule_access,
        'task_access' => $task_access
    ];
    redirect();
}

unset(
    $_SESSION['account/api-keys/new/errors'],
    $_SESSION['account/api-keys/new/values']
);

include_once '../../../fns/Users/ApiKeys/add.php';
$id = Users\ApiKeys\add($mysqli, $id_users, $name, $expire_time);

$_SESSION['account/api-keys/view/messages'] = ['API key has been generated.'];

redirect("../view/?id=$id");
