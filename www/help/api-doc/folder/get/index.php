<?php

include_once '../fns/folder_method_page.php';
folder_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the folder to get.',
    ],
], [
    'FOLDER_NOT_FOUND' => "A folder with the ID doesn't exist.",
]);
