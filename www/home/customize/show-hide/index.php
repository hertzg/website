<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

include_once 'fns/get_home_items.php';
$homeItems = get_home_items();

include_once '../fns/get_user_home_items.php';
$userHomeItems = get_user_home_items($homeItems, $user);

include_once '../../../fns/Form/checkboxItem.php';
$items = [];
foreach ($userHomeItems as $key => $item) {
    list($title, $propertyPart) = $item;
    $userProperty = "show_$propertyPart";
    $checked = $user->$userProperty;
    $items[] = Form\checkboxItem($base, $propertyPart, $title, $checked);
}

include_once '../../../fns/Form/button.php';
$items[] = Form\button('Save Changes');

unset(
    $_SESSION['home/customize/messages'],
    $_SESSION['home/customize/reorder/messages']
);

include_once '../../../fns/create_panel.php';
include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Page/imageArrowLink.php';
include_once '../../../fns/Page/imageLinkWithDescription.php';
include_once '../../../fns/Page/sessionMessages.php';
include_once '../../../fns/Page/warnings.php';
$content = create_tabs(
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
    'Show / Hide Items',
    Page\sessionMessages('home/customize/show-hide/messages')
    .Page\warnings([
        'Select items to see them on your home page.',
    ])
    .'<form action="submit.php" method="post">'
        .join('<div class="hr"></div>', $items)
    .'</form>'
    .create_panel(
        'Options',
        Page\imageLinkWithDescription('Reorder Items',
            'Change the order in which the items appear.',
            '../reorder/', 'reorder')
        .'<div class="hr"></div>'
        .Page\imageArrowLink('Restore Defaults', 'restore-defaults/',
            'restore-defaults')
    )
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Customize Home', $content, $base);
