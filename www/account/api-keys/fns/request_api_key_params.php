<?php

function request_api_key_params ($user) {

    $parseAccess = function (&$access) {
        if ($access != 'readonly' && $access != 'readwrite') $access = 'none';
    };

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($name, $expires, $bookmark_access, $channel_access,
        $contact_access, $event_access, $file_access, $note_access,
        $notification_access, $schedule_access, $task_access) = request_strings(
        'name', 'expires', 'bookmark_access', 'channel_access',
        'contact_access', 'event_access', 'file_access', 'note_access',
        'notification_access', 'schedule_access', 'task_access');

    include_once "$fnsDir/str_collapse_spaces.php";
    $name = str_collapse_spaces($name);

    include_once __DIR__.'/parse_expire_time.php';
    parse_expire_time($user, $expires, $expire_time);

    $parseAccess($bookmark_access);
    $parseAccess($channel_access);
    $parseAccess($contact_access);
    $parseAccess($event_access);
    $parseAccess($file_access);
    $parseAccess($note_access);
    $parseAccess($notification_access);
    $parseAccess($schedule_access);
    $parseAccess($task_access);

    return [$name, $expires, $expire_time, $bookmark_access, $channel_access,
        $contact_access, $event_access, $file_access, $note_access,
        $notification_access, $schedule_access, $task_access];

}
