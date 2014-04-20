<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['home/customize/messages'],
    $_SESSION['home/customize/reorder/messages']
);

include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/text.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Customize',
            'href' => '..',
        ],
    ],
    'Restore Defaults',
    Page\text('Are you sure you want to restore the default home?')
    .'<div class="hr"></div>'
    .Page\imageLink('Yes, restore defaults', 'submit.php', 'yes')
    .'<div class="hr"></div>'
    .Page\imageLink('No, return back', '..', 'no')
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Restore Defaults?', $content, $base);
