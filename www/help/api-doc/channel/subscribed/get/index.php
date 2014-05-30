<?php

include_once '../fns/subscribed_channel_method_page.php';
subscribed_channel_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the subscribed channel to get.',
    ],
], ['SUBSCRIBED_CHANNEL_NOT_FOUND']);
