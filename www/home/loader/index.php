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

$response['user']['balance_total'] = (int)$user->balance_total;
$response['user']['num_archived_received_bookmarks'] = (int)$user->num_archived_received_bookmarks;
$response['user']['num_archived_received_calculations'] = (int)$user->num_archived_received_calculations;
$response['user']['num_archived_received_contacts'] = (int)$user->num_archived_received_contacts;
$response['user']['num_archived_received_files'] = (int)$user->num_archived_received_files;
$response['user']['num_archived_received_folders'] = (int)$user->num_archived_received_folders;
$response['user']['num_archived_received_notes'] = (int)$user->num_archived_received_notes;
$response['user']['num_archived_received_places'] = (int)$user->num_archived_received_places;
$response['user']['num_archived_received_schedules'] = (int)$user->num_archived_received_schedules;
$response['user']['num_archived_received_tasks'] = (int)$user->num_archived_received_tasks;
$response['user']['num_bar_charts'] = (int)$user->num_bar_charts;
$response['user']['num_birthdays_today'] = (int)$user->num_birthdays_today;
$response['user']['num_birthdays_tomorrow'] = (int)$user->num_birthdays_tomorrow;
$response['user']['num_bookmarks'] = (int)$user->num_bookmarks;
$response['user']['num_calculations'] = (int)$user->num_calculations;
$response['user']['num_contacts'] = (int)$user->num_contacts;
$response['user']['num_deleted_items'] = (int)$user->num_deleted_items;
$response['user']['num_events_today'] = (int)$user->num_events_today;
$response['user']['num_events_tomorrow'] = (int)$user->num_events_tomorrow;
$response['user']['num_new_notifications'] = (int)$user->num_new_notifications;
$response['user']['num_notes'] = (int)$user->num_notes;
$response['user']['num_notifications'] = (int)$user->num_notifications;
$response['user']['num_places'] = (int)$user->num_places;
$response['user']['num_schedules'] = (int)$user->num_schedules;
$response['user']['num_received_bookmarks'] = (int)$user->num_received_bookmarks;
$response['user']['num_received_calculations'] = (int)$user->num_received_calculations;
$response['user']['num_received_contacts'] = (int)$user->num_received_contacts;
$response['user']['num_received_files'] = (int)$user->num_received_files;
$response['user']['num_received_folders'] = (int)$user->num_received_folders;
$response['user']['num_received_notes'] = (int)$user->num_received_notes;
$response['user']['num_received_places'] = (int)$user->num_received_places;
$response['user']['num_received_schedules'] = (int)$user->num_received_schedules;
$response['user']['num_received_tasks'] = (int)$user->num_received_tasks;
$response['user']['num_schedules_today'] = (int)$user->num_schedules_today;
$response['user']['num_schedules_tomorrow'] = (int)$user->num_schedules_tomorrow;
$response['user']['num_task_deadlines_today'] = (int)$user->num_task_deadlines_today;
$response['user']['num_task_deadlines_tomorrow'] = (int)$user->num_task_deadlines_tomorrow;
$response['user']['num_tasks'] = (int)$user->num_tasks;
$response['user']['storage_used'] = (int)$user->storage_used;

header('Content-Type: application/json');
echo json_encode($response);
