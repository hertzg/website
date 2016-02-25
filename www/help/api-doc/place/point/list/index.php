<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/place_point_method_page.php';
place_point_method_page('list', [
    [
        'name' => 'id',
        'description' => 'The ID of the place to list the points of.',
    ],
], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the points.',
            ],
            'latitude' => [
                'type' => 'number',
                'description' => 'The latitude of the point.',
            ],
            'longitude' => [
                'type' => 'number',
                'description' => 'The longitude of the point.',
            ],
            'altitude' => [
                'type' => 'number',
                'description' => 'The altitude of the point.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the point was added.',
            ],
        ],
    ],
], [
    'PLACE_NOT_FOUND' => "A place with the ID doesn't exist.",
]);
