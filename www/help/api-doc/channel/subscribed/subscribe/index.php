<?php

include_once '../../../../../../lib/defaults.php';

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
    'type' => 'number',
    'description' => 'The ID of the newly subscribed subscribed channel.',
], [
    'ENTER_CHANNEL_NAME' => 'The channel name is empty.',
    'INVALID_CHANNEL_NAME' => 'The channel name is invalid.',
    'CHANNEL_NOT_FOUND' => "A channel with the name doesn't exist.",
    'CHANNEL_NOT_PUBLIC' => 'The channel is not public.',
    'CHANNEL_IS_OWN' => 'You are the owner of the channel.',
    'ALREADY_SUBSCRIBED' => 'You are already subscribed to this channel.',
]);
