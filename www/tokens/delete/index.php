<?php

include_once 'lib/require-token.php';
include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

$page->base = '../../';
$page->title = "Delete Remembered Session #$id?";
$page->finish(
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../account/',
            ],
            [
                'title' => 'Sessions',
                'href' => '..',
            ],
        ],
        "Session #$id",
        Page::text(
            'Are you sure you want to delete the remembered session'
            .' "<b>'.bin2hex($token->tokentext).'</b>"?'
        )
        .Page::HR
        .Page::imageLink(
            'Yes, delete remembered session',
            "submit.php?id=$id",
            'yes'
        )
        .Page::HR
        .Page::imageLink('No, return back', "../view/?id=$id", 'no')
    )
);
