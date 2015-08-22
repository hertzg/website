<?php

include_once '../fns/bar_method_page.php';
include_once '../../../fns/true_result.php';
bar_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the bar to delete.',
    ],
], true_result(), [
    'BAR_NOT_FOUND' => "A bar with the ID doesn't exist.",
]);
