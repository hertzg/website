<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/bar_method_page.php';
bar_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the bar to get.',
    ],
], [
    'type' => 'object',
    'object' => [
        'id' => [
            'type' => 'number',
            'description' => 'The ID of the bar.',
        ],
        'label' => [
            'type' => 'string',
            'description' => 'The label of the bar.',
        ],
        'insert_time' => [
            'type' => 'number',
            'description' => 'The Unix timestamp of when the bar was added.',
        ],
        'update_time' => [
            'type' => 'number',
            'description' =>
                'The Unix timestamp of when the bar was last modified.',
        ],
    ],
], [
    'BAR_NOT_FOUND' => "A bar with the ID doesn't exist.",
]);
