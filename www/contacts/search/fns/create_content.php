<?php

function create_content ($user, $filterMessage, array $items) {
    include_once __DIR__.'/../../fns/create_options_panel.php';
    include_once __DIR__.'/../../../fns/create_tabs.php';
    include_once __DIR__.'/../../../fns/Page/sessionMessages.php';
    return
        create_tabs(
            [
                [
                    'title' => 'Home',
                    'href' => '../../home/',
                ],
            ],
            'Contacts',
            Page\sessionMessages('contacts/messages')
            .$filterMessage.join('<div class="hr"></div>', $items)
        )
        .create_options_panel($user, '../');
}
