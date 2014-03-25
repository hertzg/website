<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['customize-home/messages'],
    $_SESSION['customize-home/reorder/messages']
);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/text.php';
$content = create_tabs(
    array(
        array(
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ),
        array(
            'title' => 'Customize',
            'href' => '../',
        ),
    ),
    'Restore Defaults',
    Page\text('Are you sure you want to restore the default home?')
    .'<div class="hr"></div>'
    .Page\imageLink('Yes, restore defaults', 'submit.php', 'yes')
    .'<div class="hr"></div>'
    .Page\imageLink('No, return back', '../', 'no')
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Restore Defaults?', $content, $base);
