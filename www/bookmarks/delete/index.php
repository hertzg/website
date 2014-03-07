<?php

include_once '../fns/require_bookmark.php';
include_once '../../lib/mysqli.php';
list($bookmark, $id) = require_bookmark($mysqli);

unset($_SESSION['bookmarks/view/index_messages']);

include_once '../../fns/Page/text.php';
$question = Page\text('Are you sure you want to delete the bookmark?');

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../lib/page.php';

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
        $question.'<div class="hr"></div>'
        .Page\imageLink('Yes, delete bookmark', "submit.php?id=$id", 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
