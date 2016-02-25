<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/place_method_page.php';
place_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the places.',
            ],
            'latitude' => [
                'type' => 'number',
                'description' => 'The latitude of the place.',
            ],
            'longitude' => [
                'type' => 'number',
                'description' => 'The longitude of the place.',
            ],
            'altitude' => [
                'type' => 'number',
                'description' => 'The altitude of the place.',
            ],
            'name' => [
                'type' => 'string',
                'description' => 'The name of the place.',
            ],
            'description' => [
                'type' => 'string',
                'description' => 'The description of the place.',
            ],
            'tags' => [
                'type' => 'string',
                'description' => 'The space-separated list of tags.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the place was created.',
            ],
            'update_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the place was last modified.',
            ],
        ],
    ],
], []);
