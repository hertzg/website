<?php

include_once '../fns/require_token.php';
include_once '../../lib/mysqli.php';
list($token, $id) = require_token($mysqli);

include_once '../../fns/Page/text.php';
$question = Page\text(
    'Are you sure you want to delete the remembered session'
    .' "<b>'.bin2hex($token->tokentext).'</b>"?'
);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../lib/page.php';

$page->base = '../../';
$page->title = "Delete Remembered Session #$id?";
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../../account/',
            ),
            array(
                'title' => 'Sessions',
                'href' => '..',
            ),
        ),
        "Session #$id",
        $question.'<div class="hr"></div>'
        .Page\imageLink('Yes, delete remembered session',
            "submit.php?id=$id", 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
