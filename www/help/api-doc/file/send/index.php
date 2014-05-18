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
    'ENTER_RECEIVER_USERNAME', 'RECEIVER_NOT_FOUND',
    'RECEIVER_NOT_RECEIVING', 'ENTER_NAME', 'SELECT_FILE', 'FILE_ERROR',
]);
