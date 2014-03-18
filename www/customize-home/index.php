<?php

$base = '../';

include_once '../fns/require_user.php';
$user = require_user($base);

unset(
    $_SESSION['customize-home/reorder/index_messages'],
    $_SESSION['customize-home/show-hide/index_messages']
);

include_once '../fns/create_tabs.php';
include_once '../fns/Page/imageLink.php';
include_once '../fns/Page/imageLinkWithDescription.php';
$content = create_tabs(
    array(
        array(
            'title' => 'Home',
            'href' => '../home/',
        ),
    ),
    'Customize',
    Page\imageLinkWithDescription('Show / Hide Items',
        'Change the visibility of the items.', 'show-hide/', 'show-hide')
    .'<div class="hr"></div>'
    .Page\imageLinkWithDescription('Reorder Items',
        'Change the order in which the items appear.', 'reorder/', 'reorder')
);

include_once '../fns/echo_page.php';
echo_page($user, 'Customize Home', $content, $base);
