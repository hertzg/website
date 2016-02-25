<?php

include_once '../../../../../../lib/defaults.php';

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
    'type' => 'number',
    'description' => 'The ID of the imported file.',
], [
    'RECEIVED_FILE_NOT_FOUND' => "A received file with the ID doesn't exist.",
    'PARENT_FOLDER_NOT_FOUND' => "A parent folder with the ID doesn't exist.",
]);
