<?php

include_once '../fns/file_method_page.php';
file_method_page('list', [
    [
        'name' => 'parent_id',
        'description' => 'The ID of the parent folder.',
    ],
], ['FOLDER_NOT_FOUND']);
