<?php

include_once '../../fns/require_user.php';
require_user('../../');

unset($_SESSION['tokens/index_messages']);

include_once '../../fns/Page/text.php';
$question = Page\text(
    'Are you sure you want to delete all the remembered sessions?'
);

include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

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
        $question.Page::HR
        .Page::imageLink('Yes, delete all sessions', 'submit.php', 'yes')
        .Page::HR
        .Page::imageLink('No, return back', '..', 'no')
    )
);
