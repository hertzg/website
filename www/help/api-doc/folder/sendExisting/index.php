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
    'FOLDER_NOT_FOUND', 'ENTER_RECEIVER_USERNAME',
    'RECEIVER_NOT_FOUND', 'RECEIVER_NOT_RECEIVING',
]);
