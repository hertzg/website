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
        if ($key === 'admin' && !$user->admin) continue;
        list($title, $icon) = $item;
        $href = "{$base}move/?key=$key";
        if ($key === 'calendar') {
            include_once "$fnsDir/create_calendar_icon_today.php";
            $items[] =
                "<a href=\"$href\""
                ." class=\"clickable link image_link withArrow\">"
                    .'<span class="image_link-icon">'
                        .create_calendar_icon_today($user)
                    .'</span>'
                    .'<span class="image_link-content">Calendar</span>'
                .'</a>';
        } else {
            $items[] = Page\imageArrowLink($title,
                $href, $icon, ['id' => $key]);
        }
    }

    include_once __DIR__.'/create_options_panel.php';
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/text.php";
    return
        Page\create(
            [
                'title' => 'Customize',
                'href' => "$base../#reorder",
            ],
            'Reorder Items',
            Page\sessionMessages('home/customize/reorder/messages')
            .Page\text('Select an item to move up or down:')
            .join('<div class="hr"></div>', $items)
        )
        .create_options_panel($base);

}
