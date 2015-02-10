<?php

include_once '../fns/place_method_page.php';
place_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the place to delete.',
    ],
], [
    'PLACE_NOT_FOUND' => "A place with the ID doesn't exist.",
]);
