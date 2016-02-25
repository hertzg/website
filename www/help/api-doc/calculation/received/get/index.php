<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_calculation_method_page.php';
received_calculation_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the received calculation to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the received calculation.',
        ],
        'sender_username' => [
            'type' => 'string',
            'description' => 'The username of who sent the calculation.',
        ],
        'expression' => [
            'type' => 'string',
            'description' => 'The expression of the received calculation.',
        ],
        'title' => [
            'type' => 'string',
            'description' => 'The title of the received calculation.',
        ],
        'tags' => [
            'type' => 'string',
            'description' => 'The space-separated list of tags.',
        ],
        'insert_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the calculation was received.',
        ],
    ],
], [
    'RECEIVED_CALCULATION_NOT_FOUND' =>
        "A received calculation with the ID doesn't exist.",
]);
