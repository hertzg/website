<?php

include_once '../fns/folder_method_page.php';
folder_method_page('add', [
    [
        'name' => 'name',
        'description' => 'The name of the folder.',
    ],
    [
        'name' => 'parent_id',
        'description' => 'The ID of the parent folder.',
    ],
], [
    'ENTER_NAME' => 'The name is empty.',
    'FOLDER_ALREADY_EXISTS' => 'A folder with the name already exists.',
]);
