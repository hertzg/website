<?php

include_once '../fns/event_method_page.php';
event_method_page('add', [
    [
        'name' => 'text',
        'description' => 'The event text.',
    ],
    [
        'name' => 'event_time',
        'description' => 'The Unix timestamp of the day of the event.',
    ],
], [
    'type' => 'number',
    'description' => 'The ID of the newly created event.',
], [
    'ENTER_TEXT' => 'The event text is empty.',
]);
