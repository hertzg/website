<?php

include_once '../fns/file_method_page.php';
file_method_page('download', [
    [
        'name' => 'id',
        'description' => 'The ID of the file to download.',
    ],
], [
    'type' => 'binary',
], [
    'FILE_NOT_FOUND' => "A file with the ID doesn't exist.",
]);
