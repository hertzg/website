<?php

include_once '../fns/channel_method_page.php';
channel_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the channel to delete.',
    ],
], ['CHANNEL_NOT_FOUND']);
