<?php

include_once '../fns/bar_method_page.php';
bar_method_page('deleteAll', [
    [
        'name' => 'id',
        'description' => 'The ID of the bar chart to delete the bars of.',
    ],
], [
    'BAR_CHART_NOT_FOUND' => "A bar chart with the ID doesn't exist.",
]);
