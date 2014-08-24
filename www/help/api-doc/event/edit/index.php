<?php

include_once '../fns/event_method_page.php';
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
        'description' => 'The Unix timestamp of the day of the event.',
    ],
], [
    'EVENT_NOT_FOUND' => "An event with the ID doesn't exist.",
    'ENTER_TEXT' => 'The new event text is empty.',
]);
