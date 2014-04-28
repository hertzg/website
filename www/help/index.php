<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['help/feedback/errors'],
    $_SESSION['help/feedback/values'],
    $_SESSION['home/messages']
);

include_once '../fns/Page/tabs.php';
include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/imageLink.php';
include_once '../fns/Page/sessionMessages.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../home/',
        ],
    ],
    'Help',
    Page\sessionMessages('help/messages')
    .Page\imageLink('Install Zvini App', 'install/', 'download')
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Leave Feedback', 'feedback/', 'feedback')
    .'<div class="hr"></div>'
    .Page\imageArrowLink('API Documentation', 'api-doc/', 'TODO')
);

include_once '../fns/echo_page.php';
echo_page($user, 'Help', $content, $base);
