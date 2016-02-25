<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/file_method_page.php';
file_method_page('add', [
    [
        'name' => 'name',
        'description' => 'The name of the file.',
    ],
    [
        'name' => 'file',
        'description' => 'The content file to upload.',
    ],
    [
        'name' => 'parent_id',
        'description' => 'The ID of the parent folder.',
    ],
    [
        'name' => 'auto_rename',
        'description' => 'Give the file a unique name'
            .' if a file with the same name already exists.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly created file.',
], [
    'ENTER_NAME' => 'The name is empty.',
    'FILE_ALREADY_EXISTS' => 'A file with the name already exists.',
    'PARENT_FOLDER_NOT_FOUND' => "A parent folder with the ID doesn't exist.",
    'SELECT_FILE' => 'The content file is empty.',
    'FILE_ERROR' => 'An error occured while uploading the file.',
]);
