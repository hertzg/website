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
    .Page\imageLink('Install Zvini App', 'install-zvini-app/',
        'download', ['id' => 'install-zvini-app'])
    .'<div class="hr"></div>'
    .Page\imageLink('Install Link Handlers', 'install-link-handlers/',
        'protocol', ['id' => 'install-link-handlers'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Leave Feedback',
        'feedback/', 'feedback', ['id' => 'feedback'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('API Documentation',
        'api-doc/', 'generic', ['id' => 'api-doc'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('About Zvini',
        'about-zvini/', 'generic', ['id' => 'about-zvini'])
);

include_once '../fns/echo_public_page.php';
echo_public_page($user, 'Help', $content, '../');
