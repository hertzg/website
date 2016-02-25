<?php

include_once '../../lib/defaults.php';

include_once '../fns/signed_user.php';
$user = signed_user();

include_once 'fns/unset_session_vars.php';
unset_session_vars();

include_once '../fns/Page/create.php';
include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/imageLink.php';
include_once '../fns/Page/sessionMessages.php';
$content = Page\create(
    [
        'title' => 'Home',
        'href' => '../home/#help',
        'localNavigation' => true,
    ],
    'Help',
    Page\sessionMessages('help/messages')
    .Page\imageLink('Install Zvini App', 'install-zvini-app/',
        'download', ['id' => 'install-zvini-app'])
    .'<div class="hr"></div>'
    .Page\imageLink('Install Link Handlers', 'install-link-handlers/', 'protocol', [
        'id' => 'install-link-handlers',
        'localNavigation' => true,
    ])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Leave Feedback', 'feedback/', 'feedback', [
        'id' => 'feedback',
        'localNavigation' => true,
    ])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('API Documentation',
        'api-doc/', 'api-doc', ['id' => 'api-doc'])
    .'<div class="hr"></div>'
    .Page\imageArrowLink('About Zvini', 'about-zvini/', 'zvini', [
        'id' => 'about-zvini',
        'localNavigation' => true,
    ])
);

include_once '../fns/echo_public_page.php';
echo_public_page($user, 'Help', $content, '../');
