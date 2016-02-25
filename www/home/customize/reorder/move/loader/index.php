<?php

include_once '../../../../../../lib/defaults.php';

$fnsDir = '../../../../../fns';

include_once "$fnsDir/ApiCall/requireClientRevision.php";
ApiCall\requireClientRevision();

include_once "$fnsDir/ApiCall/requireUser.php";
$user = ApiCall\requireUser();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/request_strings.php";
list($key) = request_strings('key');

include_once '../../fns/get_home_items.php';
$homeItems = get_home_items();

if (!array_key_exists($key, $homeItems)) {
    include_once "$fnsDir/ApiCall/Error/badRequest.php";
    ApiCall\Error\badRequest('"ITEM_NOT_FOUND"');
}

include_once "$fnsDir/create_page_load_response.php";
$response = create_page_load_response($user);

$item = $homeItems[$key];
$response['item'] = [
    'key' => $key,
    'title' => $item[0],
];

header('Content-Type: application/json');
echo json_encode($response);
