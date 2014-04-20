<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['tasks/errors'],
    $_SESSION['tasks/messages']
);

include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content = create_tabs(
    [
        [
            'title' => 'Home',
            'href' => '../../home/',
        ],
    ],
    'Tasks',
    Page\text('Are you sure you want to delete all the tasks?')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete all task', 'submit.php', 'yes'),
        Page\imageLink('No, return back', '..', 'no')
    )
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Delete All Tasks?', $content, $base);
