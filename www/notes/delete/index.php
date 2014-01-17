<?php

include_once 'lib/require-note.php';
include_once '../../classes/Tab.php';
include_once '../../lib/page.php';

$page->base = '../../';
$page->title = 'Delete Note?';
$page->finish(
    Tab::create(
        Tab::item('Notes', '../')
        .Tab::activeItem('View'),
        Page::text('Are you sure you want to delete the note?')
        .Page::HR
        .Page::imageLink('Yes, delete note', "submit.php?id=$id", 'yes')
        .Page::HR
        .Page::imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
