<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

include_once 'fns/get_home_items.php';
$homeItems = get_home_items();

include_once '../fns/get_user_home_items.php';
$userHomeItems = get_user_home_items($homeItems, $user);

include_once "$fnsDir/Page/imageArrowLink.php";
$items = [];
foreach ($userHomeItems as $key => $item) {
    list($title, $icon) = $item;
    $items[] = Page\imageArrowLink($title, "move/?key=$key", $icon);
}

unset($_SESSION['home/customize/messages']);

include_once 'fns/create_options_panel.php';
include_once "$fnsDir/Page/sessionMessages.php";
include_once "$fnsDir/Page/tabs.php";
include_once "$fnsDir/Page/warnings.php";
$content = Page\tabs(
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
    'Reorder Items',
    Page\sessionMessages('home/customize/reorder/messages')
    .Page\warnings(['Select an item to move up or down.'])
    .join('<div class="hr"></div>', $items)
    .create_options_panel()
);

include_once "$fnsDir/echo_page.php";
echo_page($user, 'Reorder Items', $content, $base);
