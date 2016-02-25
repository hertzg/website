<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/schedule_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
schedule_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the schedule to delete.',
    ],
], ApiDoc\trueResult(), [
    'SCHEDULE_NOT_FOUND' => "A schedule with the ID doesn't exist.",
]);
