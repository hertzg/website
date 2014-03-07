<?php

include_once '../../../fns/require_user.php';
require_user('../../../');

include_once '../../../fns/Page/text.php';
$question = Page\text('Are you sure you want to delete all the events?');

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../lib/page.php';

$page->title = 'Delete All Events?';
$page->base = '../../../';
$page->finish(
    create_tabs(
        array(
            array(
                'title' => '&middot;&middot;&middot;',
                'href' => '../../..',
            ),
            array(
                'title' => 'Calendar',
                'href' => '../..',
            ),
        ),
        'All Events',
        $question.'<div class="hr"></div>'
        .Page\imageLink('Yes, delete all events', 'submit.php', 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', '..', 'no')
    )
);
