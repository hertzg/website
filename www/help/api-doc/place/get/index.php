<?php

include_once '../fns/place_method_page.php';
place_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the place to get.',
    ],
], [
    'PLACE_NOT_FOUND' => "A place with the ID doesn't exist.",
]);
