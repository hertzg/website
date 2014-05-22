<?php

include_once '../fns/event_method_page.php';
event_method_page('edit', [
    [
        'name' => 'id',
        'description' => 'The ID of the event to edit.',
    ],
    [
        'name' => 'text',
        'description' => 'The new text of the event.',
    ],
    [
        'name' => 'event_time',
        'description' => 'The Unix timestamp of the day of the event.',
    ],
], ['EVENT_NOT_FOUND', 'ENTER_TEXT']);
