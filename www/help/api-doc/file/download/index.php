<?php

include_once '../fns/file_method_page.php';
file_method_page('download', [
    [
        'name' => 'id',
        'description' => 'The ID of the file to download.',
    ],
], ['FILE_NOT_FOUND']);
