<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id) = require_bookmark($mysqli);

include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

unset($_SESSION['bookmarks/view/index_messages']);

$page->base = '../../';
$page->title = "Delete Bookmark #$id?";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Bookmarks',
                'href' => '..',
            ),
        ),
        "Bookmark #$id",
        Page::text('Are you sure you want to delete the bookmark?')
        .Page::HR
        .Page::imageLink('Yes, delete bookmark', "submit.php?id=$id", 'yes')
        .Page::HR
        .Page::imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
