<?php

include_once '../fns/event_method_page.php';
event_method_page('get', [
    [
        'name' => 'id',
        'description' => 'The ID of the event to get.',
    ],
], ['EVENT_NOT_FOUND']);
