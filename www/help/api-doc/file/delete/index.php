<?php

include_once '../fns/file_method_page.php';
include_once '../../fns/true_result.php';
file_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the file to delete.',
    ],
], true_result(), [
    'FILE_NOT_FOUND' => "A file with the ID doesn't exist.",
]);
