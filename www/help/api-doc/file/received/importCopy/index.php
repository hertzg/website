<?php

include_once '../fns/received_file_method_page.php';
received_file_method_page('importCopy', [
    [
        'name' => 'id',
        'description' => 'The ID of the received file to copy.',
    ],
    [
        'name' => 'parent_id',
        'description' => 'The ID of the parent folder.',
    ],
], ['RECEIVED_FILE_NOT_FOUND', 'FOLDER_NOT_FOUND']);
