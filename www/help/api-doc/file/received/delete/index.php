<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_file_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
received_file_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received file to delete.',
    ],
], ApiDoc\trueResult(), [
    'RECEIVED_FILE_NOT_FOUND' => "A received file with the ID doesn't exist.",
]);
