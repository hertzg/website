<?php

include_once '../fns/require_api_key.php';
include_once '../../../lib/mysqli.php';
list($apiKey, $id, $user) = require_api_key($mysqli);

unset($_SESSION['account/api-keys/view/messages']);

include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'API Keys',
            'href' => '..',
        ],
    ],
    "API Key #$id",
    Page\text('Are you sure you want to remove the API Key?')
    .'<div class="hr"></div>'
    .Page\imageLink('Yes, delete API key', "submit.php?id=$id", 'yes')
    .'<div class="hr"></div>'
    .Page\imageLink('No, return back', "../view/?id=$id", 'no')
);

include_once '../../../fns/echo_page.php';
echo_page($user, "Delete API Key #$id", $content, '../../../');
