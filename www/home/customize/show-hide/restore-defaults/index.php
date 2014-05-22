<?php

$base = '../../../../';

include_once '../../../../fns/require_user.php';
$user = require_user($base);

unset($_SESSION['home/customize/show-hide/messages']);

include_once '../../../../fns/Page/tabs.php';
include_once '../../../../fns/Page/imageLink.php';
include_once '../../../../fns/Page/text.php';
include_once '../../../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Show / Hide Items',
            'href' => '..',
        ],
    ],
    'Restore Defaults',
    Page\text('Are you sure you want to restore'
        .' the default visibility of the items?')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, restore defaults', 'submit.php', 'yes'),
        Page\imageLink('No, return back', '..', 'no')
    )
);

include_once '../../../../fns/echo_page.php';
echo_page($user, 'Restore Defaults?', $content, $base);
