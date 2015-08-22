<?php

include_once '../fns/bar_chart_method_page.php';
include_once '../../fns/true_result.php';
bar_chart_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the bar chart to edit.',
    ],
    [
        'name' => 'name',
        'description' => 'The new name of the bar chart.',
    ],
], true_result(), [
    'BAR_CHART_NOT_FOUND' => "A bar chart with the ID doesn't exist.",
    'ENTER_NAME' => 'The new name is empty.',
]);
