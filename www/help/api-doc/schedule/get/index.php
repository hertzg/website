<?php

include_once '../fns/schedule_method_page.php';
schedule_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the schedule to get.',
    ],
], ['SCHEDULE_NOT_FOUND']);
