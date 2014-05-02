<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../../home/',
        ],
    ],
    'Schedules',
    Page\text('Are your sure you want to delete all the schedules?')
    .'<div class="hr"></div>'
    .Page\imageLink('Yes, delete all schedules', 'submit.php', 'yes')
    .'<div class="hr"></div>'
    .Page\imageLink('No, return back', '..', 'no')
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Delete All Schedules', $content, $base);
