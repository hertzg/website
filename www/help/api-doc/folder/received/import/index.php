<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_folder_method_page.php';
received_folder_method_page('import', [
    [
        'name' => 'id',
        'description' => 'The ID of the received folder to move.',
    ],
    [
        'name' => 'parent_id',
        'description' => 'The ID of the parent folder.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the imported folder.',
], [
    'RECEIVED_FOLDER_NOT_FOUND' =>
        "A received folder with the ID doesn't exist.",
    'PARENT_FOLDER_NOT_FOUND' => "A parent folder with the ID doesn't exist.",
]);
