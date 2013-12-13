<?php

include_once 'lib/require-note.php';
include_once '../classes/Page.php';
include_once '../classes/Tab.php';

$page->base = '../';
$page->title = 'Delete Note: '.htmlspecialchars(mb_substr($note->notetext, 0, 20, 'UTF-8'));
$page->finish(
    Tab::create(
        Tab::item('Notes', 'index.php')
        .Tab::activeItem('View')
    )
    .Page::text('Are you sure you want to delete the note?')
    .Page::HR
    .Page::imageLink('Yes, delete note', "submit-delete.php?id=$id", 'yes')
    .Page::HR
    .Page::imageLink('No, return back', "view.php?id=$id", 'no')
);
