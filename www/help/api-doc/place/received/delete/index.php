<?php

include_once '../fns/received_place_method_page.php';
include_once '../../../fns/true_result.php';
received_place_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received place to delete.',
    ],
], true_result(), [
    'RECEIVED_PLACE_NOT_FOUND' => "A received place with the ID doesn't exist.",
]);
