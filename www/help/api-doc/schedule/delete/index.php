<?php

include_once '../fns/schedule_method_page.php';
schedule_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the schedule to delete.',
    ],
], [
    'SCHEDULE_NOT_FOUND' => "A schedule with the ID doesn't exist.",
]);
