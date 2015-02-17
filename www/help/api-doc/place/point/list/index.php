<?php

include_once '../fns/place_point_method_page.php';
place_point_method_page('list', [
    [
        'name' => 'id',
        'description' => 'The ID of the place.',
    ],
], [
    'PLACE_NOT_FOUND' => "A place with the ID doesn't exist.",
]);
