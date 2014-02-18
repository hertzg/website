<?php

include_once 'lib/require-user.php';
include_once '../../lib/page.php';

unset($_SESSION['tokens/index_messages']);

include_once '../../fns/create_tabs.php';

$page->base = '../../';
$page->title = 'Delete All Remembered Sessions?';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../..',
            ),
            array(
                'title' => 'Account',
                'href' => '../../account/',
            ),
        ),
        'Sessions',
        Page::text(
            'Are you sure you want to delete all the remembered sessions?'
        )
        .Page::HR
        .Page::imageLink('Yes, delete all sessions', 'submit.php', 'yes')
        .Page::HR
        .Page::imageLink('No, return back', '..', 'no')
    )
);
