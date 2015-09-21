<?php

namespace SearchPage;

function createContent ($user, $filterMessage, $items, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once __DIR__.'/../create_options_panel.php';
    include_once __DIR__.'/../sort_panel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/compressed_js_script.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        \Page\tabs(
            [
                [
                    'title' => 'Home',
                    'href' => '../../search/?keyword='.rawurlencode($keyword),
                ],
            ],
            'Schedules',
            \Page\sessionErrors('schedules/errors')
            .\Page\sessionMessages('schedules/messages')
            .$filterMessage.join('<div class="hr"></div>', $items)
            .sort_panel($user, '../')
            .create_options_panel($user, '../'),
            create_new_item_button('Schedule', '../')
        )
        .compressed_js_script('searchForm', '../../');

}
