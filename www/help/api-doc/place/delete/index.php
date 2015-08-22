<?php

include_once '../fns/place_method_page.php';
include_once '../../fns/true_result.php';
place_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the place to delete.',
    ],
], true_result(), [
    'PLACE_NOT_FOUND' => "A place with the ID doesn't exist.",
]);
