<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $user) = require_api_key($mysqli);

include_once '../fns/request_api_key_params.php';
include_once '../../../lib/mysqli.php';
$values = request_api_key_params(
    $mysqli, $user, $errors, $apiKey->id);
list($name, $expires, $expire_time, $bar_chart_access,
    $bookmark_access, $calculation_access, $channel_access, $contact_access,
    $event_access, $file_access, $note_access, $notification_access,
    $place_access, $schedule_access, $task_access,
    $wallet_access) = $values;

include_once "$fnsDir/request_strings.php";
list($randomizeKey) = request_strings('randomizeKey');

$randomizeKey = (bool)$randomizeKey;

include_once "$fnsDir/ItemList/itemQuery.php";
$itemQuery = ItemList\itemQuery($id);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['account/api-keys/edit/errors'] = $errors;
    $_SESSION['account/api-keys/edit/values'] = [
        'name' => $name,
        'expires' => $expires,
        'randomizeKey' => $randomizeKey,
        'bar_chart_access' => $bar_chart_access,
        'bookmark_access' => $bookmark_access,
        'calculation_access' => $calculation_access,
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
    redirect("./$itemQuery");
}

unset(
    $_SESSION['account/api-keys/edit/errors'],
    $_SESSION['account/api-keys/edit/values']
);

include_once '../fns/parse_read_write.php';
parse_read_write($bar_chart_access,
    $can_read_bar_charts, $can_write_bar_charts);
parse_read_write($bookmark_access, $can_read_bookmarks, $can_write_bookmarks);
parse_read_write($calculation_access,
    $can_read_calculations, $can_write_calculations);
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
Users\ApiKeys\edit($mysqli, $apiKey, $name, $expire_time,
    $can_read_bar_charts, $can_read_bookmarks, $can_read_calculations,
    $can_read_channels, $can_read_contacts, $can_read_events, $can_read_files,
    $can_read_notes, $can_read_notifications, $can_read_places,
    $can_read_schedules, $can_read_tasks, $can_read_wallets,
    $can_write_bar_charts, $can_write_bookmarks, $can_write_calculations,
    $can_write_channels, $can_write_contacts, $can_write_events,
    $can_write_files, $can_write_notes, $can_write_notifications,
    $can_write_places, $can_write_schedules,
    $can_write_tasks, $can_write_wallets, $changed);

if ($randomizeKey) {
    include_once "$fnsDir/ApiKeys/randomizeKey.php";
    ApiKeys\randomizeKey($mysqli, $id);
}

if ($changed || $randomizeKey) $message = 'Changes have been saved.';
else $message = 'No changes to be saved.';
$_SESSION['account/api-keys/view/messages'] = [$message];

redirect("../view/$itemQuery");
