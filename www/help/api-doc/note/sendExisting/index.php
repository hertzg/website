<?php

include_once '../fns/note_method_page.php';
note_method_page('sendExisting', [
    [
        'name' => 'id',
        'description' => 'The ID of the note to send.',
    ],
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
], [
    'NOTE_NOT_FOUND', 'ENTER_RECEIVER_USERNAME',
    'RECEIVER_NOT_FOUND', 'RECEIVER_NOT_RECEIVING',
]);
