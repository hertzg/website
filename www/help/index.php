<?php

include_once '../fns/require_user.php';
require_user('../');

include_once '../fns/Page/sessionMessages.php';
$pageMessages = Page\sessionMessages('help/index_messages');

unset(
    $_SESSION['help/feedback/index_errors'],
    $_SESSION['help/feedback/index_lastpost']
);

include_once '../fns/create_tabs.php';
include_once '../fns/Page/imageArrowLink.php';
include_once '../fns/Page/imageLink.php';
$content =
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '..',
            ),
        ),
        'Help',
        $pageMessages
        .Page\imageLink('Install Zvini App', 'install.php', 'download')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Leave Feedback', 'feedback/', 'feedback')
    );

include_once '../fns/echo_page.php';
echo_page($user, 'Help', $content, '../');
