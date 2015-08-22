<?php

include_once '../fns/bar_method_page.php';
include_once '../../../fns/true_result.php';
bar_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the bar to edit.',
    ],
    [
        'name' => 'value',
        'description' => 'The new value of the bar.',
    ],
    [
        'name' => 'label',
        'description' => 'The new label of the bar.',
    ],
], true_result(), [
    'BAR_NOT_FOUND' => "A bar with the ID doesn't exist.",
]);
