<?php

include_once '../fns/subscribed_channel_method_page.php';
subscribed_channel_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the subscribed channel to edit.',
    ],
    [
        'name' => 'receive_notifications',
        'description' => 'Whether the subscriber'
            .' should receive notifications.',
    ],
], ['SUBSCRIBED_CHANNEL_NOT_FOUND']);
