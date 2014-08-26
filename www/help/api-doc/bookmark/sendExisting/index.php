<?php

include_once '../fns/bookmark_method_page.php';
bookmark_method_page('sendExisting', [
    [
        'name' => 'id',
        'description' => 'The ID of the bookmark to send.',
    ],
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
], [
    'BOOKMARK_NOT_FOUND' => "A bookmark with the ID doesn't exist.",
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection"
        .' to receive bookmarks from you.',
]);
