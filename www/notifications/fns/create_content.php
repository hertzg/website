<?php

function create_content ($items, $options) {
    include_once __DIR__.'/../../fns/create_panel.php';
    include_once __DIR__.'/../../fns/Page/tabs.php';
    include_once __DIR__.'/../../fns/Page/sessionErrors.php';
    include_once __DIR__.'/../../fns/Page/sessionMessages.php';
    return Page\tabs(
        [
            [
                'title' => 'Home',
                'href' => '../home/',
            ],
        ],
        'Notifications',
        Page\sessionErrors('notifications/errors')
        .Page\sessionMessages('notifications/messages')
        .join('<div class="hr"></div>', $items)
        .create_panel('Options', join('<div class="hr"></div>', $options))
    );
}
