<?php

function create_content ($user, $filterMessage, $items) {

    $fnsDir = __DIR__.'/../../fns';

    include_once __DIR__.'/../fns/create_options_panel.php';
    include_once "$fnsDir/create_new_item_button.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/tabs.php";
    return
        Page\tabs(
            [
                [
                    'title' => 'Home',
                    'href' => '../home/',
                ],
            ],
            'Tasks',
            Page\sessionErrors('tasks/errors')
            .Page\sessionMessages('tasks/messages')
            .$filterMessage.join('<div class="hr"></div>', $items),
            create_new_item_button('Task')
        )
        .create_options_panel($user);

}
