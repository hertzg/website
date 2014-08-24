<?php

include_once '../fns/file_method_page.php';
file_method_page('list', [
    [
        'name' => 'parent_id',
        'description' => 'The ID of the parent folder.',
    ],
], [
    'FILE_NOT_FOUND' => "A file with the ID doesn't exist.",
]);
