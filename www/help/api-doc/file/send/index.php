<?php

include_once '../fns/file_method_page.php';
file_method_page('send', [
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
    [
        'name' => 'name',
        'description' => 'The name of the file.',
    ],
    [
        'name' => 'file',
        'description' => 'The content file to upload.',
    ],
], [
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection to receive files from you.",
    'ENTER_NAME' => 'The name is empty.',
    'SELECT_FILE' => 'The content file is empty.',
    'FILE_ERROR' => 'An error occured while uploading the file.',
]);
