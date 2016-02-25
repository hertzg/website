<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/channel_user_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
channel_user_method_page('add', [
    [
        'name' => 'id',
        'description' => 'The ID of the channel to add the user to.',
    ],
    [
        'name' => 'username',
        'description' => 'The Zvini username of the user to add.',
    ],
], ApiDoc\trueResult(), [
    'CHANNEL_NOT_FOUND' => "A channel with the ID doesn't exist.",
    'ENTER_USERNAME' => 'The username is empty.',
    'USER_NOT_FOUND' => 'No such user with the username.',
    'USER_IS_SELF' => 'The user you tried to add is you.',
    'USER_ALREADY_ADDED' => 'The user is already added.',
    'USER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection to receive channels from you.",
]);
