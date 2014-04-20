<?php

function create_content ($user, $filterMessage, array $items) {
    include_once __DIR__.'/../fns/create_options_panel.php';
    include_once __DIR__.'/../../fns/Page/tabs.php';
    include_once __DIR__.'/../../fns/Page/sessionErrors.php';
    include_once __DIR__.'/../../fns/Page/sessionMessages.php';
    return
        create_tabs(
            [
                [
                    'title' => 'Home',
                    'href' => '../home/',
                ],
            ],
            'Notes',
            Page\sessionErrors('notes/errors')
            .Page\sessionMessages('notes/messages')
            .$filterMessage.join('<div class="hr"></div>', $items)
        )
        .create_options_panel($user);
}
