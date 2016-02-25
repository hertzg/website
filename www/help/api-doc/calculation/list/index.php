<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/calculation_method_page.php';
calculation_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the calculations.',
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
                'description' => 'The Unix timestamp of'
                    .' when the calculation was last modified.',
            ],
        ],
    ],
], []);
