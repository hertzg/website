<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id) = require_note($mysqli);

include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

unset($_SESSION['notes/view/index_messages']);

$page->base = '../../';
$page->title = "Delete Note #$id?";
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ],
            [
                'title' => 'Notes',
                'href' => '..',
            ],
        ],
        "Note #$id",
        Page::text('Are you sure you want to delete the note?')
        .Page::HR
        .Page::imageLink('Yes, delete note', "submit.php?id=$id", 'yes')
        .Page::HR
        .Page::imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
