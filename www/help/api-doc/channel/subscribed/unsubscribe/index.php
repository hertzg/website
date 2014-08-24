<?php

include_once '../fns/subscribed_channel_method_page.php';
subscribed_channel_method_page('unsubscribe', [
    [
        'name' => 'id',
        'description' => 'The ID of the subscribed channel'
            .' to unsubscribe from.',
    ],
], [
    'SUBSCRIBED_CHANNEL_NOT_FOUND' =>
        "A subscribed channel with the ID doesn't exist.",
]);
