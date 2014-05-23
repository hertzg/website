<?php

include_once '../fns/channel_user_method_page.php';
channel_user_method_page('remove', [
    [
        'name' => 'id',
        'description' => 'The ID of the channel.',
    ],
    [
        'name' => 'username',
        'description' => 'The Zvini username of the user to remove.',
    ],
], [
    'CHANNEL_NOT_FOUND', 'ENTER_USERNAME', 'USER_NOT_ADDED',
]);
