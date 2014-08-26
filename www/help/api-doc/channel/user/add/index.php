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
    'CHANNEL_NOT_FOUND' => "A channel with the ID doesn't exist.",
    'ENTER_USERNAME' => 'The username is empty.',
    'USER_NOT_FOUND' => 'No such user with the username.',
    'USER_IS_SELF' => 'The user you tried to add is you.',
    'USER_ALREADY_ADDED' => 'The user is already added.',
    'USER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection to receive channels from you.",
]);
