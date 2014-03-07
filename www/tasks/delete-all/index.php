<?php

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/Page/text.php';
$question = Page\text('Are you sure you want to delete all the tasks?');

unset($_SESSION['tasks/index_messages']);

include_once '../../fns/create_tabs.php';
include_once '../../lib/page.php';

$page->base = '../../';
$page->title = 'Delete All Tasks?';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => 'Home',
                'href' => '../..',
            ),
        ),
        'Tasks',
        $question.'<div class="hr"></div>'
        .Page::imageLink('Yes, delete all task', 'submit.php', 'yes')
        .'<div class="hr"></div>'
        .Page::imageLink('No, return back', '..', 'no')
    )
);
