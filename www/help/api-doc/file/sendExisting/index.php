<?php

include_once '../fns/file_method_page.php';
file_method_page('sendExisting', [
    [
        'name' => 'id',
        'description' => 'The ID of the file to send.',
    ],
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
], [
    'FILE_NOT_FOUND', 'ENTER_RECEIVER_USERNAME',
    'RECEIVER_NOT_FOUND', 'RECEIVER_NOT_RECEIVING',
]);
