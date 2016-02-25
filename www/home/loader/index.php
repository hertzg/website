<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/ApiCall/requireClientRevision.php";
ApiCall\requireClientRevision();

include_once "$fnsDir/ApiCall/requireUser.php";
$user = ApiCall\requireUser();

include_once "$fnsDir/HomePage/unsetSessionVars.php";
HomePage\unsetSessionVars();

include_once "$fnsDir/create_page_load_response.php";
$response = create_page_load_response($user);

$key = 'home/messages';
if (array_key_exists($key, $_SESSION)) $response['messages'] = $_SESSION[$key];

include_once "$fnsDir/Users/Home/get.php";
$response['home'] = $home = Users\Home\get($user);

include_once "$fnsDir/HomePage/notificationWarnings.php";
include_once '../../lib/mysqli.php';
$warnings = HomePage\notificationWarnings($mysqli, $user);
if ($warnings) $response['warnings'] = $warnings;

$export = function ($field) use ($user, &$response) {
    $response['user'][$field] = (int)$user->$field;
};

if (array_key_exists('bar-charts', $home)) $export('num_bar_charts');
if (array_key_exists('bookmarks', $home)) {
    $export('num_bookmarks');
    $export('num_received_bookmarks');
    $export('num_archived_received_bookmarks');
}
if (array_key_exists('calculations', $home)) {
    $export('num_calculations');
    $export('num_received_calculations');
    $export('num_archived_received_calculations');
}
if (array_key_exists('calendar', $home)) {

    include_once "$fnsDir/user_time_today.php";
    $time_today = user_time_today($user);

    include_once "$fnsDir/HomePage/checkEventCheckDay.php";
    HomePage\checkEventCheckDay($mysqli, $user, $time_today);

    include_once "$fnsDir/HomePage/checkTaskDeadlineCheckDay.php";
    HomePage\checkTaskDeadlineCheckDay($mysqli, $user, $time_today);

    include_once "$fnsDir/HomePage/checkBirthdayCheckDay.php";
    HomePage\checkBirthdayCheckDay($mysqli, $user, $time_today);

    $export('num_birthdays_today');
    $export('num_birthdays_tomorrow');
    $export('num_events_today');
    $export('num_events_tomorrow');
    $export('num_task_deadlines_today');
    $export('num_task_deadlines_tomorrow');

}
if (array_key_exists('contacts', $home)) {
    $export('num_contacts');
    $export('num_received_contacts');
    $export('num_archived_received_contacts');
}
if (array_key_exists('files', $home)) {
    $export('storage_used');
    $export('num_received_files');
    $export('num_received_folders');
    $export('num_archived_received_files');
    $export('num_archived_received_folders');
}
if (array_key_exists('notes', $home)) {
    $export('num_notes');
    $export('num_received_notes');
    $export('num_archived_received_notes');
}
if (array_key_exists('notifications', $home)) {
    $export('num_new_notifications');
    $export('num_notifications');
}
if (array_key_exists('places', $home)) {
    $export('num_places');
    $export('num_received_places');
    $export('num_archived_received_places');
}
if (array_key_exists('schedules', $home)) {

    include_once "$fnsDir/HomePage/checkScheduleCheckDay.php";
    HomePage\checkScheduleCheckDay($mysqli, $user);

    $export('num_schedules_today');
    $export('num_schedules_tomorrow');
    $export('num_received_schedules');
    $export('num_archived_received_schedules');

}
if (array_key_exists('tasks', $home)) {
    $export('num_tasks');
    $export('num_received_tasks');
    $export('num_archived_received_tasks');
}
if (array_key_exists('wallets', $home)) $export('balance_total');
if (array_key_exists('trash', $home)) $export('num_deleted_items');

header('Content-Type: application/json');
echo json_encode($response);
