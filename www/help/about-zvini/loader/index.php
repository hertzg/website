<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/ApiCall/requireClientRevision.php";
ApiCall\requireClientRevision();

include_once "$fnsDir/signed_user.php";
$user = signed_user();

include_once '../fns/unset_session_vars.php';
unset_session_vars();

include_once "$fnsDir/create_page_load_response.php";
$response = create_page_load_response($user);

include_once '../fns/get_git_commit.php';
get_git_commit($hash, $tag, $date);

$response['gitCommit'] = [
    'hash' => $hash,
    'tag' => $tag,
    'date' => $date,
];

header('Content-Type: application/json');
echo json_encode($response);
