<?php

function create_content ($items, $options) {
    $fnsDir = __DIR__.'/../../fns';
    include_once "$fnsDir/create_panel.php";
    include_once "$fnsDir/Page/sessionErrors.php";
    include_once "$fnsDir/Page/sessionMessages.php";
    include_once "$fnsDir/Page/tabs.php";
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
