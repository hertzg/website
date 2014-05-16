<?php

include_once '../fns/folder_method_page.php';
folder_method_page('rename', [
    [
        'name' => 'id',
        'description' => 'The ID of the folder to rename.',
    ],
    [
        'name' => 'name',
        'description' => 'The new name of the folder.',
    ],
], ['ENTER_NAME', 'FOLDER_ALREADY_EXISTS']);
