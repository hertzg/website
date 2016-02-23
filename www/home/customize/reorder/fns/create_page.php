<?php

function create_page ($user, &$head, &$scripts, $base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/compressed_css_link.php";
    $head = compressed_css_link('confirmDialog', "$base../../../")
        .compressed_css_link('calendarIcon', "$base../../../");

    include_once "$fnsDir/compressed_js_script.php";
    $scripts = compressed_js_script('calendarIcon', "$base../../../");

    include_once __DIR__.'/get_home_items.php';
    $homeItems = get_home_items();

    include_once __DIR__.'/../../fns/get_user_home_items.php';
    $userHomeItems = get_user_home_items($homeItems, $user);

    $first = true;
    $content = '';
    include_once "$fnsDir/Page/imageArrowLink.php";
    foreach ($userHomeItems as $key => $item) {

        if ($first) $first = false;
        else $content .= '<div class="hr"></div>';

        $href = "{$base}move/?key=$key";
        if ($key === 'calendar') {
            include_once "$fnsDir/create_calendar_icon_today.php";
            $content .=
                '<a name="calendar"></a>'
                ."<a href=\"$href\" id=\"calendar\""
                ." class=\"clickable link image_link withArrow localNavigation-link\">"
                    .'<span class="image_link-icon">'
                        .create_calendar_icon_today($user)
                    .'</span>'
                    .'<span class="image_link-content">Calendar</span>'
                .'</a>';
        } else {
            $content .= Page\imageArrowLink($item[0], $href, $item[1], [
                'id' => $key,
                'localNavigation' => true,
            ]);
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
                'localNavigation' => true,
            ],
            'Reorder Items',
            Page\sessionMessages('home/customize/reorder/messages')
            .Page\text('Select an item to move up or down:')
            .$content
        )
        .create_options_panel($base);

}
