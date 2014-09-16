<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['trash/errors'],
    $_SESSION['trash/messages']
);

include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => 'Trash',
            'href' => '..',
        ],
    ],
    'Empty',
    Page\text('Are you sure you want to empty the trash?'
        .' All the items in it will be purged.')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, empty trash', 'submit.php', 'yes'),
        Page\imageLink('No, return back', '..', 'no')
    )
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Empty Trash?', $content, $base);
