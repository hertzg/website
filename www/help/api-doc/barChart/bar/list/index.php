<?php

include_once '../fns/bar_method_page.php';
bar_method_page('list', [
    [
        'name' => 'id',
        'description' => 'The ID of the bar chart to list the bars of.',
    ],
], [
    'WALLET_NOT_FOUND' => "A bar chart with the ID doesn't exist.",
]);
