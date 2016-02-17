<?php

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
$response['home'] = Users\Home\get($user);

include_once "$fnsDir/HomePage/checkScheduleCheckDay.php";
include_once '../../lib/mysqli.php';
HomePage\checkScheduleCheckDay($mysqli, $user);

include_once "$fnsDir/user_time_today.php";
$time_today = user_time_today($user);

include_once "$fnsDir/HomePage/checkEventCheckDay.php";
HomePage\checkEventCheckDay($mysqli, $user, $time_today);

include_once "$fnsDir/HomePage/checkTaskDeadlineCheckDay.php";
HomePage\checkTaskDeadlineCheckDay($mysqli, $user, $time_today);

include_once "$fnsDir/HomePage/checkBirthdayCheckDay.php";
HomePage\checkBirthdayCheckDay($mysqli, $user, $time_today);

include_once "$fnsDir/HomePage/notificationWarnings.php";
$warnings = HomePage\notificationWarnings($mysqli, $user);
if ($warnings) $response['warnings'] = $warnings;

$export_int = function ($field) use ($user, &$response) {
    $response['user'][$field] = (int)$user->$field;
};

$export_int('balance_total');
$export_int('num_archived_received_bookmarks');
$export_int('num_archived_received_calculations');
$export_int('num_archived_received_contacts');
$export_int('num_archived_received_files');
$export_int('num_archived_received_folders');
$export_int('num_archived_received_notes');
$export_int('num_archived_received_places');
$export_int('num_archived_received_schedules');
$export_int('num_archived_received_tasks');
$export_int('num_bar_charts');
$export_int('num_birthdays_today');
$export_int('num_birthdays_tomorrow');
$export_int('num_bookmarks');
$export_int('num_calculations');
$export_int('num_contacts');
$export_int('num_deleted_items');
$export_int('num_events_today');
$export_int('num_events_tomorrow');
$export_int('num_new_notifications');
$export_int('num_notes');
$export_int('num_notifications');
$export_int('num_places');
$export_int('num_schedules');
$export_int('num_received_bookmarks');
$export_int('num_received_calculations');
$export_int('num_received_contacts');
$export_int('num_received_files');
$export_int('num_received_folders');
$export_int('num_received_notes');
$export_int('num_received_places');
$export_int('num_received_schedules');
$export_int('num_received_tasks');
$export_int('num_schedules_today');
$export_int('num_schedules_tomorrow');
$export_int('num_task_deadlines_today');
$export_int('num_task_deadlines_tomorrow');
$export_int('num_tasks');
$export_int('storage_used');

header('Content-Type: application/json');
echo json_encode($response);
