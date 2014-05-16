<?php

include_once '../fns/file_method_page.php';
file_method_page('rename', [
    [
        'name' => 'id',
        'description' => 'The ID of the file to rename.',
    ],
    [
        'name' => 'name',
        'description' => 'The new name of the file.',
    ],
], ['ENTER_NAME', 'FILE_ALREADY_EXISTS']);
