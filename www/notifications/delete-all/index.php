<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['notifications/errors'],
    $_SESSION['notifications/messages']
);

include_once '../../fns/ItemList/escapedPageQuery.php';
$escapedPageQuery = ItemList\escapedPageQuery();

include_once '../../fns/Page/imageLink.php';
include_once '../../fns/Page/tabs.php';
include_once '../../fns/Page/text.php';
include_once '../../fns/Page/twoColumns.php';
$content = Page\tabs(
    [
        [
            'title' => 'Home',
            'href' => '../../home/',
        ],
    ],
    'Notifications',
    Page\text('Are you sure you want to delete all the notifications?')
    .'<div class="hr"></div>'
    .Page\twoColumns(
        Page\imageLink('Yes, delete all notifications', 'submit.php', 'yes'),
        Page\imageLink('No, return back', "../$escapedPageQuery", 'no')
    )
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Delete All Notifications?', $content, $base);
