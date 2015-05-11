<?php

function request_api_key_params () {

    $parseAccess = function (&$access) {
        if ($access != 'readonly' && $access != 'readwrite') $access = 'none';
    };

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($name, $expires, $bar_chart_access, $bookmark_access,
        $channel_access, $contact_access, $event_access,
        $file_access, $note_access, $notification_access, $place_access,
        $schedule_access, $task_access, $wallet_access) = request_strings(
        'name', 'expires', 'bar_chart_access', 'bookmark_access',
        'channel_access', 'contact_access', 'event_access',
        'file_access', 'note_access', 'notification_access', 'place_access',
        'schedule_access', 'task_access', 'wallet_access');

    include_once "$fnsDir/str_collapse_spaces.php";
    $name = str_collapse_spaces($name);

    include_once "$fnsDir/ApiKeyName/maxLength.php";
    $name = mb_substr($name, 0, ApiKeyName\maxLength(), 'UTF-8');

    include_once __DIR__.'/../../fns/parse_expire_time.php';
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

    return [$name, $expires, $expire_time, $bar_chart_access,
        $bookmark_access, $channel_access, $contact_access, $event_access,
        $file_access, $note_access, $notification_access, $place_access,
        $schedule_access, $task_access, $wallet_access];

}
