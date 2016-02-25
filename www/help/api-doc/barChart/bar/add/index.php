<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/bar_method_page.php';
bar_method_page('add', [
    [
        'name' => 'id',
        'description' => 'The ID of the bar chart to add the bar to.',
    ],
    [
        'name' => 'value',
        'description' => 'The value of the bar.',
    ],
    [
        'name' => 'label',
        'description' => 'The label of the bar.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly added bar.',
], [
    'BAR_CHART_NOT_FOUND' => "A bar chart with the ID doesn't exist.",
]);
