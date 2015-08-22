<?php

include_once '../fns/folder_method_page.php';
include_once '../../fns/true_result.php';
folder_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the folder to delete.',
    ],
], true_result(), [
    'FOLDER_NOT_FOUND' => "A folder with the ID doesn't exist.",
]);
