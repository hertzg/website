<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['home/customize/reorder/messages'],
    $_SESSION['home/customize/show-hide/messages']
);

include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageArrowLinkWithDescription.php';
include_once '../../fns/Page/sessionMessages.php';
$content = create_tabs(
    [
        [
            'title' => 'Home',
            'href' => '..',
        ],
    ],
    'Customize',
    Page\sessionMessages('home/customize/messages')
    .Page\imageArrowLinkWithDescription('Show / Hide Items',
        'Change the visibility of the items.', 'show-hide/', 'show-hide')
    .'<div class="hr"></div>'
    .Page\imageArrowLinkWithDescription('Reorder Items',
        'Change the order in which the items appear.', 'reorder/', 'reorder')
    .'<div class="hr"></div>'
    .Page\imageArrowLink('Restore Defaults', 'restore-defaults/',
        'restore-defaults')
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Customize Home', $content, $base);
