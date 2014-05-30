<?php

include_once '../fns/subscribed_channel_method_page.php';
subscribed_channel_method_page('subscribe', [
    [
        'name' => 'channel_name',
        'description' => 'The name of the public channel to subscribe to.',
    ],
    [
        'name' => 'receive_notifications',
        'description' => 'Whether the subscriber'
            .' should receive notifications.',
    ],
], [
    'ENTER_CHANNEL_NAME', 'CHANNEL_NOT_FOUND', 'CHANNEL_NOT_PUBLIC',
    'CHANNEL_IS_OWN', 'ALREADY_SUBSCRIBED',
]);
