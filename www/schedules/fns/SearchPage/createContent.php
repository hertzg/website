<?php

namespace SearchPage;

function createContent ($user, $total, $filterMessage, $items, $keyword) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once __DIR__.'/../create_options_panel.php';
    include_once __DIR__.'/../create_tabs.php';
    include_once __DIR__.'/../sort_panel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/Page/create.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    return
        \Page\create(
            [
                'title' => 'Home',
                'href' => '../../search/?keyword='.rawurlencode($keyword),
            ],
            'Schedules',
            create_tabs($user, '../')
            .\Page\sessionErrors('schedules/errors')
            .\Page\sessionMessages('schedules/messages')
            .$filterMessage.join('<div class="hr"></div>', $items),
            create_new_item_button('Schedule', '../')
        )
        .sort_panel($user, $total, '../')
        .create_options_panel($user, '../');

}
