<?php

$fnsDir = __DIR__.'/../../fns';

include_once "$fnsDir/session_start_custom.php";
session_start_custom($new);

unset($_SESSION['admin/messages']);

include_once "$fnsDir/Page/imageArrowLink.php";
include_once "$fnsDir/Page/tabs.php";
$content = Page\tabs(
    [
        [
            'title' => 'Administration',
            'href' => '../#help',
        ],
    ],
    'Help',
    Page\imageArrowLink('Exchange API Documentation',
        'exchange-api-doc', 'api-doc', ['id' => 'exchange-api-doc'])
);

include_once '../fns/echo_admin_page.php';
echo_admin_page('Help', $content, '../');
