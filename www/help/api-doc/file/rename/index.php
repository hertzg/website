<?php

include_once '../fns/file_method_page.php';
include_once '../../fns/true_result.php';
file_method_page('rename', [
    [
        'name' => 'id',
        'description' => 'The ID of the file to rename.',
    ],
    [
        'name' => 'name',
        'description' => 'The new name of the file.',
    ],
], true_result(), [
    'FILE_NOT_FOUND' => "A file with the ID doesn't exist.",
    'ENTER_NAME' => 'The new name is empty.',
    'FILE_ALREADY_EXISTS' => 'A file with the name already exists.',
]);
