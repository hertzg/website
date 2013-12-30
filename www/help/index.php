<?php

include_once 'lib/require-user.php';
include_once '../classes/Tab.php';
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

$page->base = '../';
$page->title = 'Leave Feedback';
$page->finish(
    Tab::create(
        Tab::activeItem('Help'),
        $pageMessages
        .Page::imageLink('Feedback', 'feedback.php', 'feedback')
    )
);
