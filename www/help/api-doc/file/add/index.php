<?php

include_once '../fns/file_method_page.php';
file_method_page('add', [
    [
        'name' => 'name',
        'description' => 'The name of the file.',
    ],
    [
        'name' => 'file',
        'description' => 'File content.',
    ],
    [
        'name' => 'parent_id',
        'description' => 'The ID of the parent folder.',
    ],
], ['ENTER_NAME', 'FILE_ALREADY_EXISTS', 'SELECT_FILE', 'FILE_ERROR']);
