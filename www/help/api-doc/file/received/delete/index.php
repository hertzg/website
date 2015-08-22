<?php

include_once '../fns/received_file_method_page.php';
include_once '../../../fns/true_result.php';
received_file_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received file to delete.',
    ],
], true_result(), [
    'RECEIVED_FILE_NOT_FOUND' => "A received file with the ID doesn't exist.",
]);
