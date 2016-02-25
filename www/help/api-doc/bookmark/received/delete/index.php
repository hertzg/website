<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_bookmark_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
received_bookmark_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received bookmark to delete.',
    ],
], ApiDoc\trueResult(), [
    'RECEIVED_BOOKMARK_NOT_FOUND' =>
        "A received bookmark with the ID doesn't exist.",
]);
