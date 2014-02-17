<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

unset($_SESSION['tasks/index_messages']);

$page->base = '../../';
$page->title = 'Delete All Tasks?';
$page->finish(
    create_tabs(
        [
            [
                'title' => 'Home',
                'href' => '../..',
            ],
        ],
        'Tasks',
        Page::text('Are you sure you want to delete all the tasks?')
        .Page::HR
        .Page::imageLink(
            'Yes, delete all task',
            'submit.php',
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', '..', 'no')
    )
);
