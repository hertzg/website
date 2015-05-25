<?php

namespace SearchPage;

function createContent ($user, $items, $filterMessage) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once __DIR__.'/../create_options_panel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/compressed_js_script.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Home',
                    'href' => '../../home/#bar-charts',
                ],
            ],
            'Bar Charts',
            \Page\sessionMessages('bar-charts/messages')
            .$filterMessage
            .join('<div class="hr"></div>', $items),
            create_new_item_button('Bar Chart', '../')
        )
        .create_options_panel($user, '../')
        .compressed_js_script('searchForm', '../../');

}
