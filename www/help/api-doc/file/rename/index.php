<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/file_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
file_method_page('rename', [
    [
        'name' => 'id',
        'description' => 'The ID of the file to rename.',
    ],
    [
        'name' => 'name',
        'description' => 'The new name of the file.',
    ],
], ApiDoc\trueResult(), [
    'FILE_NOT_FOUND' => "A file with the ID doesn't exist.",
    'ENTER_NAME' => 'The new name is empty.',
    'FILE_ALREADY_EXISTS' => 'A file with the name already exists.',
]);
