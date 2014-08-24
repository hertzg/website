<?php

include_once '../fns/received_file_method_page.php';
received_file_method_page('import', [
    [
        'name' => 'id',
        'description' => 'The ID of the received file to move.',
    ],
    [
        'name' => 'parent_id',
        'description' => 'The ID of the parent folder.',
    ],
], [
    'RECEIVED_FILE_NOT_FOUND' => "A received file with the ID doesn't exist.",
    'FOLDER_NOT_FOUND' => "A parent folder with the ID doesn't exist.",
]);
