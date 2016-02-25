<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/bar_chart_method_page.php';
bar_chart_method_page('list', [], [
    'type' => 'array',
    'item' => [
        'type' => 'object',
        'object' => [
            'id' => [
                'type' => 'number',
                'description' => 'The ID of one of the bar charts.',
            ],
            'name' => [
                'type' => 'string',
                'description' => 'The name of the bar chart.',
            ],
            'tags' => [
                'type' => 'string',
                'description' => 'The space-separated list of tags.',
            ],
            'insert_time' => [
                'type' => 'number',
                'description' =>
                    'The Unix timestamp of when the bar chart was created.',
            ],
            'update_time' => [
                'type' => 'number',
                'description' => 'The Unix timestamp of'
                    .' when the bar chart was last modified.',
            ],
        ],
    ],
], []);
