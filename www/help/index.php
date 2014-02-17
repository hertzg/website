<?php

include_once 'lib/require-user.php';
include_once '../lib/page.php';

if (array_key_exists('help/index_messages', $_SESSION)) {
    $pageMessages = Page::messages($_SESSION['help/index_messages']);
} else {
    $pageMessages = '';
}

unset(
    $_SESSION['help/feedback_errors'],
    $_SESSION['help/feedback_lastpost']
);

include_once '../fns/create_tabs.php';

$page->base = '../';
$page->title = 'Help';
$page->finish(
    create_tabs(
        [
            [
                'title' => 'Home',
                'href' => '..',
            ],
        ],
        'Help',
        $pageMessages
        .Page::imageLink('Install Zvini App', 'install.php', 'download')
        .Page::HR
        .Page::imageLink('Leave Feedback', 'feedback.php', 'feedback')
    )
);
