<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/bar_chart_method_page.php';
bar_chart_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the bar chart to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the bar chart.',
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
            'description' =>
                'The Unix timestamp of when the bar chart was last modified.',
        ],
    ],
], [
    'BAR_CHART_NOT_FOUND' => "A bar chart with the ID doesn't exist.",
]);
