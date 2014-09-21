<?php

include_once '../fns/require_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $user) = require_api_key($mysqli);

$base = '../../../';
$fnsDir = '../../../fns';

unset($_SESSION['account/api-keys/view/messages']);

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($apiKey)
    .Page\confirmDialog('Are you sure you want to delete the API key?',
        'Yes, delete API key', "submit.php?id=$id", "../view/?id=$id");

include_once "$fnsDir/compressed_css_link.php";
include_once "$fnsDir/echo_page.php";
echo_page($user, "Delete API Key #$id?", $content, $base, [
    'head' => compressed_css_link('confirmDialog', $base),
]);
