<?php

include_once '../fns/folder_method_page.php';
folder_method_page('sendExisting', [
    [
        'name' => 'id',
        'description' => 'The ID of the folder to send.',
    ],
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
], [
    'FOLDER_NOT_FOUND' => "A folder with the ID doesn't exist.",
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'INVALID_RECEIVER_USERNAME' => 'The receiver username is invalid.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection to receive folders from you.",
]);
