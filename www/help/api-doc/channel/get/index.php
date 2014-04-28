<?php

include_once '../fns/channel_method_page.php';
channel_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the channel to get.',
    ],
], ['CHANNEL_NOT_FOUND']);
