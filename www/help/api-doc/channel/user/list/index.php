<?php

include_once '../fns/channel_user_method_page.php';
channel_user_method_page('list', [
    [
        'name' => 'id',
        'description' => 'The ID of the channel.',
    ],
], ['CHANNEL_NOT_FOUND']);
