<?php

function create_content ($content, $user, $base, $searchForm) {

    $fnsDir = __DIR__.'/../../fns';

    include_once __DIR__.'/create_options_panel.php';
    include_once "$fnsDir/Page/newItemButton.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    $content = Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => "$base../home/#bar-charts",
            ],
        ],
        'Bar Charts',
        Page\sessionErrors('bar-charts/errors')
        .Page\sessionMessages('bar-charts/messages')
        .$content
        .create_options_panel($user),
        Page\newItemButton("{$base}new/", 'Bar Chart')
    );

    if ($searchForm) {
        include_once "$fnsDir/compressed_js_script.php";
        $content .= compressed_js_script('searchForm', "$base../");
    }

    return $content;

}
