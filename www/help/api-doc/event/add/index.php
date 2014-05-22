<?php

include_once '../fns/event_method_page.php';
event_method_page('add', [
    [
        'name' => 'text',
        'description' => 'The text of the event.',
    ],
    [
        'name' => 'event_time',
        'description' => 'The Unix timestamp of the day of the event.',
    ],
], ['ENTER_TEXT']);
