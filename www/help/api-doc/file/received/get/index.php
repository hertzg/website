<?php

include_once '../fns/received_file_method_page.php';
received_file_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the received file to get.',
    ],
], [
    'RECEIVED_FILE_NOT_FOUND' => "A received file with the ID doesn't exist.",
]);
