<?php

include_once '../fns/channel_user_method_page.php';
include_once '../../../fns/true_result.php';
channel_user_method_page('remove', [
    [
        'name' => 'id',
        'description' => 'The ID of the channel remove the user from.',
    ],
    [
        'name' => 'username',
        'description' => 'The Zvini username of the user to remove.',
    ],
], true_result(), [
    'CHANNEL_NOT_FOUND' => "A channel with the ID doesn't exist.",
    'ENTER_USERNAME' => 'The username is empty.',
    'USER_NOT_FOUND' => 'No such user with the username.',
    'USER_NOT_ADDED' => 'The user is not added to the channel.',
]);
