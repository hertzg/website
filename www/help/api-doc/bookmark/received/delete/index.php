<?php

include_once '../fns/received_bookmark_method_page.php';
include_once '../../../fns/true_result.php';
received_bookmark_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received bookmark to delete.',
    ],
], true_result(), [
    'RECEIVED_BOOKMARK_NOT_FOUND' =>
        "A received bookmark with the ID doesn't exist.",
]);
