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
    'BOOKMARK_NOT_FOUND', 'ENTER_RECEIVER_USERNAME',
    'RECEIVER_NOT_FOUND', 'RECEIVER_NOT_RECEIVING',
]);
