<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/file_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
file_method_page('sendExisting', [
    [
        'name' => 'id',
        'description' => 'The ID of the file to send.',
    ],
    [
        'name' => 'receiver_username',
        'description' => 'The Zvini username of the receiver.',
    ],
], ApiDoc\trueResult(), [
    'FILE_NOT_FOUND' => "A file with the ID doesn't exist.",
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'INVALID_RECEIVER_USERNAME' => 'The receiver username is invalid.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection to receive files from you.",
]);
