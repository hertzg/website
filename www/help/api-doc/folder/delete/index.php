<?php

include_once '../fns/folder_method_page.php';
folder_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the folder to delete.',
    ],
], ['FOLDER_NOT_FOUND']);
