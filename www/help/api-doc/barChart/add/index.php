<?php

include_once '../fns/bar_chart_method_page.php';
bar_chart_method_page('add', [
    [
        'name' => 'name',
        'description' => 'The name of the bar chart.',
    ],
], [
    'ENTER_NAME' => 'The name is empty.',
]);
