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

$response['user']['balance_total'] = (int)$user->balance_total;
$response['user']['num_archived_received_bookmarks'] = (int)$user->num_archived_received_bookmarks;
$response['user']['num_archived_received_contacts'] = (int)$user->num_archived_received_contacts;
$response['user']['num_archived_received_notes'] = (int)$user->num_archived_received_notes;
$response['user']['num_archived_received_tasks'] = (int)$user->num_archived_received_tasks;
$response['user']['num_bar_charts'] = (int)$user->num_bar_charts;
$response['user']['num_bookmarks'] = (int)$user->num_bookmarks;
$response['user']['num_contacts'] = (int)$user->num_contacts;
$response['user']['num_deleted_items'] = (int)$user->num_deleted_items;
$response['user']['num_notes'] = (int)$user->num_notes;
$response['user']['num_received_bookmarks'] = (int)$user->num_received_bookmarks;
$response['user']['num_received_contacts'] = (int)$user->num_received_contacts;
$response['user']['num_received_notes'] = (int)$user->num_received_notes;
$response['user']['num_received_tasks'] = (int)$user->num_received_tasks;
$response['user']['num_tasks'] = (int)$user->num_tasks;

header('Content-Type: application/json');
echo json_encode($response);
