<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/place_point_method_page.php';
place_point_method_page('add', [
    [
        'name' => 'id',
        'description' => 'The ID of the place to add the point to.',
    ],
    [
        'name' => 'latitude',
        'description' => 'The latitude of the point.',
    ],
    [
        'name' => 'longitude',
        'description' => 'The longitude of the point.',
    ],
    [
        'name' => 'altitude',
        'description' => 'The altitude of the point.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly added point.',
], [
    'PLACE_NOT_FOUND' => "A place with the ID doesn't exist.",
]);
