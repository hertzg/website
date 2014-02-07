<?php

include_once 'lib/require-user.php';
include_once '../../classes/Tab.php';
include_once '../../lib/page.php';

unset($_SESSION['tasks/index_messages']);

$page->base = '../../';
$page->title = 'Delete All Tasks?';
$page->finish(
    Tab::create(
        Tab::item('Home', '../..')
        .Tab::activeItem('Tasks'),
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
