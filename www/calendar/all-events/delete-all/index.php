<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
$content =
    create_tabs(
        [
            [
                'title' => '&middot;&middot;&middot;',
                'href' => '../../../home/',
            ],
            [
                'title' => 'Calendar',
                'href' => '../..',
            ],
        ],
        'All Events',
        Page\text('Are you sure you want to delete all the events?')
        .'<div class="hr"></div>'
        .Page\imageLink('Yes, delete all events', 'submit.php', 'yes')
        .'<div class="hr"></div>'
        .Page\imageLink('No, return back', '..', 'no')
    );

include_once '../../../fns/echo_page.php';
echo_page($user, 'Delete All Events?', $content, $base);
