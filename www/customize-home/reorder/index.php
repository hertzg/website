<?php

$base = '../../';

include_once '../../fns/require_user.php';
$user = require_user($base);

include_once 'fns/get_home_items.php';
$homeItems = get_home_items();

include_once '../fns/get_user_home_items.php';
$userHomeItems = get_user_home_items($homeItems, $user);

include_once '../../fns/Page/imageArrowLink.php';
$items = array();
foreach ($userHomeItems as $key => $item) {
    list($title, $icon) = $item;
    $items[] = Page\imageArrowLink($title, "move/?key=$key", $icon);
}

include_once '../../fns/create_panel.php';
include_once '../../fns/create_tabs.php';
include_once '../../fns/Page/imageArrowLink.php';
include_once '../../fns/Page/imageLinkWithDescription.php';
include_once '../../fns/Page/sessionMessages.php';
include_once '../../fns/Page/warnings.php';
$content = create_tabs(
    array(
        array(
            'title' => '&middot;&middot;&middot;',
            'href' => '../../home/',
        ),
        array(
            'title' => 'Customize',
            'href' => '../../customize-home/',
        ),
    ),
    'Reorder Items',
    Page\sessionMessages('customize-home/reorder/index_messages')
    .Page\warnings(array('Select an item to move up or down.'))
    .join('<div class="hr"></div>', $items)
    .create_panel(
        'Options',
        Page\imageArrowLink('Restore Defaults', 'restore-defaults/', 'todo')
        .'<div class="hr"></div>'
        .Page\imageLinkWithDescription('Show / Hide Items',
            'Change the visibility of the items.', '../show-hide/', 'show-hide')
    )
);

include_once '../../fns/echo_page.php';
echo_page($user, 'Reorder Items', $content, $base);
