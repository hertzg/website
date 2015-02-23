<?php

include_once '../fns/channel_user_method_page.php';
channel_user_method_page('list', [
    [
        'name' => 'id',
        'description' => 'The ID of the channel to list the users of.',
    ],
], [
    'CHANNEL_NOT_FOUND' => "A channel with the ID doesn't exist.",
]);
