<?php

function create_content ($user, $filterMessage, array $items) {
    include_once __DIR__.'/../fns/create_options_panel.php';
    include_once __DIR__.'/../../fns/create_tabs.php';
    include_once __DIR__.'/../../fns/Page/sessionErrors.php';
    include_once __DIR__.'/../../fns/Page/sessionMessages.php';
    return
        create_tabs(
            array(
                array(
                    'title' => 'Home',
                    'href' => '../home/',
                ),
            ),
            'Contacts',
            Page\sessionErrors('contacts/index_errors')
            .Page\sessionMessages('contacts/index_messages')
            .$filterMessage.join('<div class="hr"></div>', $items)
        )
        .create_options_panel($user);
}
