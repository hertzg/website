<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_place_method_page.php';
received_place_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the received place to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the received place.',
        ],
        'sender_username' => [
            'type' => 'string',
            'description' => 'The username of who sent the place.',
        ],
        'latitude' => [
            'type' => 'number',
            'description' => 'The latitude of the received place.',
        ],
        'longitude' => [
            'type' => 'number',
            'description' => 'The longitude of the received place.',
        ],
        'altitude' => [
            'type' => 'number',
            'description' => 'The altitude of the received place.',
        ],
        'name' => [
            'type' => 'string',
            'description' => 'The name of the received place.',
        ],
        'description' => [
            'type' => 'string',
            'description' => 'The description of the received place.',
        ],
        'tags' => [
            'type' => 'string',
            'description' => 'The space-separated list of tags.',
        ],
        'insert_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the place was received.',
        ],
    ],
], [
    'RECEIVED_PLACE_NOT_FOUND' => "A received place with the ID doesn't exist.",
]);
