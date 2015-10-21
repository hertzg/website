<?php

function request_api_key_params ($mysqli, $user, &$errors, $exclude_id = 0) {

    $parseAccess = function (&$access) {
        if ($access != 'readonly' && $access != 'readwrite') $access = 'none';
    };

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/ApiKeyName/request.php";
    $name = ApiKeyName\request();

    include_once "$fnsDir/request_strings.php";
    list($expires, $bar_chart_access, $bookmark_access,
        $channel_access, $contact_access, $event_access,
        $file_access, $note_access, $notification_access, $place_access,
        $schedule_access, $task_access, $wallet_access) = request_strings(
        'expires', 'bar_chart_access', 'bookmark_access',
        'channel_access', 'contact_access', 'event_access',
        'file_access', 'note_access', 'notification_access', 'place_access',
        'schedule_access', 'task_access', 'wallet_access');

    include_once "$fnsDir/parse_expire_time.php";
    parse_expire_time($expires, $expire_time);

    $parseAccess($bar_chart_access);
    $parseAccess($bookmark_access);
    $parseAccess($channel_access);
    $parseAccess($contact_access);
    $parseAccess($event_access);
    $parseAccess($file_access);
    $parseAccess($note_access);
    $parseAccess($notification_access);
    $parseAccess($place_access);
    $parseAccess($schedule_access);
    $parseAccess($task_access);
    $parseAccess($wallet_access);

    if ($name === '') $errors[] = 'Enter name.';
    else {
        include_once "$fnsDir/Users/ApiKeys/getByName.php";
        $apiKey = Users\ApiKeys\getByName($mysqli, $user, $name, $exclude_id);
        if ($apiKey) $errors[] = 'An API key with this name already exists.';
    }

    return [$name, $expires, $expire_time, $bar_chart_access,
        $bookmark_access, $channel_access, $contact_access, $event_access,
        $file_access, $note_access, $notification_access, $place_access,
        $schedule_access, $task_access, $wallet_access];

}
