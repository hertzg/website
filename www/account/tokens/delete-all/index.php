<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['account/tokens/errors'],
    $_SESSION['account/tokens/messages']
);

include_once '../../../fns/Page/imageLink.php';
include_once '../../../fns/Page/tabs.php';
include_once '../../../fns/Page/text.php';
include_once '../../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => 'Account',
            'href' => '../..',
        ],
    ],
    'Sessions',
    Page\text(
        'Are you sure you want to delete all the remembered sessions?'
    )
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete all sessions', 'submit.php', 'yes'),
        Page\imageLink('No, return back', '..', 'no')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Delete All Remembered Sessions?', $content, $base);
