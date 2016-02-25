<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_schedule_method_page.php';
received_schedule_method_page('importCopy', [
    [
        'name' => 'id',
        'description' => 'The ID of the received schedule to copy.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the imported schedule.',
], [
    'RECEIVED_SCHEDULE_NOT_FOUND' =>
        "A received schedule with the ID doesn't exist.",
]);
