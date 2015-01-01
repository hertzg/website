<?php

function create_page ($user, $base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once __DIR__.'/get_home_items.php';
    $homeItems = get_home_items();

    include_once __DIR__.'/../../fns/get_user_home_items.php';
    $userHomeItems = get_user_home_items($homeItems, $user);

    include_once "$fnsDir/Page/imageArrowLink.php";
    $items = [];
    foreach ($userHomeItems as $key => $item) {
        list($title, $icon) = $item;
        $items[] = Page\imageArrowLink($title,
            "{$base}move/?key=$key", $icon, ['id' => $key]);
    }

    include_once __DIR__.'/create_options_panel.php';
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    include_once "$fnsDir/Page/warnings.php";
    return Page\tabs(
        [
            [
                'title' => 'Customize',
                'href' => "$base../#reorder",
            ],
        ],
        'Reorder Items',
        Page\sessionMessages('home/customize/reorder/messages')
        .Page\warnings(['Select an item to move up or down.'])
        .join('<div class="hr"></div>', $items)
        .create_options_panel($base)
    );

}
