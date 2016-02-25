<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/file_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
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
], ApiDoc\trueResult(), [
    'ENTER_RECEIVER_USERNAME' => 'The receiver username is empty.',
    'INVALID_RECEIVER_USERNAME' => 'The receiver username is invalid.',
    'RECEIVER_NOT_FOUND' => 'No such receiver with the username.',
    'RECEIVER_NOT_RECEIVING' =>
        "The receiver hasn't opened a connection to receive files from you.",
    'ENTER_NAME' => 'The name is empty.',
    'SELECT_FILE' => 'The content file is empty.',
    'FILE_ERROR' => 'An error occured while uploading the file.',
]);
