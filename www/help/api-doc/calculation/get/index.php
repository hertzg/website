<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/calculation_method_page.php';
calculation_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the calculation to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the calculation.',
        ],
        'expression' => [
            'type' => 'string',
            'description' => 'The expression of the calculation.',
        ],
        'title' => [
            'type' => 'string',
            'description' => 'The title of the calculation.',
        ],
        'tags' => [
            'type' => 'string',
            'description' => 'The space-separated list of tags.',
        ],
        'insert_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the calculation was created.',
        ],
        'update_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the calculation was last modified.',
        ],
    ],
], [
    'CALCULATION_NOT_FOUND' => "A calculation with the ID doesn't exist.",
]);
