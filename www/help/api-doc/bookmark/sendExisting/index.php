<?php

include_once '../fns/bookmark_method_page.php';
include_once '../../fns/true_result.php';
bookmark_method_page('sendExisting', [
    [
        'name' => 'id',
        'description' => 'The ID of the bookmark to send.',
    ],
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
], true_result(), [
    'BOOKMARK_NOT_FOUND' => "A bookmark with the ID doesn't exist.",
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'INVALID_RECEIVER_USERNAME' => 'The receiver username is invalid.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection"
        .' to receive bookmarks from you.',
]);
