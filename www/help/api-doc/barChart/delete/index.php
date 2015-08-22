<?php

include_once '../fns/bar_chart_method_page.php';
include_once '../../fns/true_result.php';
bar_chart_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the bar chart to delete.',
    ],
], true_result(), [
    'BAR_CHART_NOT_FOUND' => "A bar chart with the ID doesn't exist.",
]);
