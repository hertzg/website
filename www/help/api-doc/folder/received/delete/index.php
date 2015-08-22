<?php

include_once '../fns/received_folder_method_page.php';
include_once '../../../fns/true_result.php';
received_folder_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received folder to delete.',
    ],
], true_result(), [
    'RECEIVED_FOLDER_NOT_FOUND' =>
        "A received folder with the ID doesn't exist.",
]);
