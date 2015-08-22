<?php

include_once '../fns/schedule_method_page.php';
include_once '../../fns/true_result.php';
schedule_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the schedule to delete.',
    ],
], true_result(), [
    'SCHEDULE_NOT_FOUND' => "A schedule with the ID doesn't exist.",
]);
