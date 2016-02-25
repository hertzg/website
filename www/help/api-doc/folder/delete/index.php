<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/folder_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
folder_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the folder to delete.',
    ],
], ApiDoc\trueResult(), [
    'FOLDER_NOT_FOUND' => "A folder with the ID doesn't exist.",
]);
