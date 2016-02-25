<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/file_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
file_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the file to delete.',
    ],
], ApiDoc\trueResult(), [
    'FILE_NOT_FOUND' => "A file with the ID doesn't exist.",
]);
