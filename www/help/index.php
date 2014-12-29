<?php

include_once '../fns/signed_user.php';
$user = signed_user();

unset(
    $_SESSION['help/feedback/errors'],
    $_SESSION['help/feedback/values'],
    $_SESSION['home/messages']
);

include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/imageLink.php';
include_once '../fns/Page/sessionMessages.php';
include_once '../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../home/#help',
        ],
    ],
    'Help',
    Page\sessionMessages('help/messages')
    .Page\imageLink('Install Zvini App',
        'install/', 'download', ['id' => 'install'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Leave Feedback',
        'feedback/', 'feedback', ['id' => 'feedback'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('API Documentation',
        'api-doc/', 'generic', ['id' => 'api_doc'])
);

include_once '../fns/echo_page.php';
echo_page($user, 'Help', $content, '../');
