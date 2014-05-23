<?php

include_once '../fns/channel_user_method_page.php';
channel_user_method_page('add', [
    [
        'name' => 'id',
        'description' => 'The ID of the channel.',
    ],
    [
        'name' => 'username',
        'description' => 'The Zvini username of the user to add.',
    ],
], [
    'CHANNEL_NOT_FOUND', 'ENTER_USERNAME', 'USER_NOT_FOUND',
    'USER_IS_SELF', 'USER_ALREADY_ADDED', 'USER_NOT_RECEIVING',
]);
