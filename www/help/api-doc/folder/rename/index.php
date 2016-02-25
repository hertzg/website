<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/folder_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
folder_method_page('rename', [
    [
        'name' => 'id',
        'description' => 'The ID of the folder to rename.',
    ],
    [
        'name' => 'name',
        'description' => 'The new name of the folder.',
    ],
], ApiDoc\trueResult(), [
    'FOLDER_NOT_FOUND' => "A folder with the ID doesn't exist.",
    'ENTER_NAME' => 'The new name is empty.',
    'FOLDER_ALREADY_EXISTS' => 'A folder with the name already exists.',
]);
