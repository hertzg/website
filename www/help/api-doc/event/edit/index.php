<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/event_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
event_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the event to edit.',
    ],
    [
        'name' => 'text',
        'description' => 'The new event text.',
    ],
    [
        'name' => 'event_time',
        'description' => 'The new Unix timestamp of the day of the event.',
    ],
    [
        'name' => 'start_hour',
        'description' => 'The new hour when the event starts.',
    ],
    [
        'name' => 'start_minute',
        'description' => 'The new minute when the event starts.',
    ],
], ApiDoc\trueResult(), [
    'EVENT_NOT_FOUND' => "An event with the ID doesn't exist.",
    'ENTER_TEXT' => 'The new event text is empty.',
]);
