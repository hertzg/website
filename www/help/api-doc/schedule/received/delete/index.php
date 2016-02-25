<?php

include_once '../../../../../../lib/defaults.php';

include_once '../fns/received_schedule_method_page.php';
include_once '../../../../../fns/ApiDoc/trueResult.php';
received_schedule_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the received schedule to delete.',
    ],
], ApiDoc\trueResult(), [
    'RECEIVED_SCHEDULE_NOT_FOUND' =>
        "A received schedule with the ID doesn't exist.",
]);
