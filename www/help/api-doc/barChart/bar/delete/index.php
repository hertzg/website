<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/bar_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
bar_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the bar to delete.',
    ],
], ApiDoc\trueResult(), [
    'BAR_NOT_FOUND' => "A bar with the ID doesn't exist.",
]);
