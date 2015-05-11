<?php

include_once '../fns/bar_chart_method_page.php';
bar_chart_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the bar chart to delete.',
    ],
], [
    'BAR_CHART_NOT_FOUND' => "A bar chart with the ID doesn't exist.",
]);
