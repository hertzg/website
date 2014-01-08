<?php

include_once 'lib/require-user.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

$page->base = '../';
$page->title = 'Delete All Notes?';
$page->finish(
    Tab::create(
        Tab::activeItem('Notes'),
        Page::text('Are you sure you want to delete all the notes?')
        .Page::HR
        .Page::imageLink(
            'Yes, delete all notes',
            'submit-delete-all.php',
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', 'view.php', 'no')
    )
);
