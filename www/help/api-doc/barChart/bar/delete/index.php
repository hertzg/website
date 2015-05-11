<?php

include_once '../fns/bar_method_page.php';
bar_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the bar to delete.',
    ],
], [
    'BAR_NOT_FOUND' => "A bar with the ID doesn't exist.",
]);
