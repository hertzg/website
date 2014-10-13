<?php

include_once '../fns/received_folder_method_page.php';
received_folder_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the received folder to get.',
    ],
], [
    'RECEIVED_FOLDER_NOT_FOUND' =>
        "A received folder with the ID doesn't exist.",
]);
