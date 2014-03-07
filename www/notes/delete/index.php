<?php

include_once '../fns/require_note.php';
include_once '../../lib/mysqli.php';
list($note, $id) = require_note($mysqli);

unset($_SESSION['notes/view/index_messages']);

include_once '../../fns/Page/text.php';
$question = Page\text('Are you sure you want to delete the note?');

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../lib/page.php';

$page->base = '../../';
$page->title = "Delete Note #$id?";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Notes',
                'href' => '..',
            ),
        ),
        "Note #$id",
        $question.'<div class="hr"></div>'
        .Page\imageLink('Yes, delete note', "submit.php?id=$id", 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
