<?php

function create_content ($user, $filterMessage, array $items) {
    include_once __DIR__.'/../fns/create_options_panel.php';
    include_once __DIR__.'/../../fns/Page/tabs.php';
    include_once __DIR__.'/../../fns/Page/sessionErrors.php';
    include_once __DIR__.'/../../fns/Page/sessionMessages.php';
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
            .$filterMessage.join('<div class="hr"></div>', $items)
        )
        .create_options_panel($user);
}
