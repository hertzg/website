<?php

include_once 'lib/require-user.php';
include_once '../classes/Tab.php';
include_once '../lib/page.php';

$page->base = '../';
$page->title = 'Delete All Remembered Sessions?';
$page->finish(
    Tab::create(
        Tab::item('Account', '../account.php')
        .Tab::activeItem('Remembered Sessions'),
        Page::text(
            'Are you sure you want to delete all the remembered sessions?'
        )
        .Page::HR
        .Page::imageLink(
            'Yes, delete all sessions',
            'submit-delete-all.php',
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', './', 'no')
    )
);
