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
], ['ENTER_NAME', 'FOLDER_ALREADY_EXISTS']);
