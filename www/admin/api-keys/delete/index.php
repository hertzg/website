<?php

include_once '../fns/require_admin_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id) = require_admin_api_key($mysqli);

unset($_SESSION['admin/api-keys/view/messages']);

$fnsDir = '../../../fns';

include_once '../fns/ViewPage/create.php';
include_once "$fnsDir/Page/confirmDialog.php";
$content =
    ViewPage\create($mysqli, $apiKey, $scripts)
    .Page\confirmDialog('Are you sure you want to delete the admin API key?',
        'Yes, delete admin API key', "submit.php?id=$id", "../view/?id=$id");

include_once '../../fns/echo_admin_page.php';
include_once "$fnsDir/compressed_css_link.php";
echo_admin_page("Delete Admin API Key #$id?", $content, '../../', [
    'head' => compressed_css_link('confirmDialog', '../../../'),
    'scripts' => $scripts,
]);
