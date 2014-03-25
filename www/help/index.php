<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['help/feedback/index_errors'],
    $_SESSION['help/feedback/index_values']
);

include_once '../fns/create_tabs.php';
include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/imageLink.php';
include_once '../fns/Page/sessionMessages.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../home/',
            ),
        ),
        'Help',
        Page\sessionMessages('help/index_messages')
        .Page\imageLink('Install Zvini App', 'install.php', 'download')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Leave Feedback', 'feedback/', 'feedback')
    );

include_once '../fns/echo_page.php';
echo_page($user, 'Help', $content, $base);
