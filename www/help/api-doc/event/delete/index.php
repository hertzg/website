<?php

include_once '../fns/event_method_page.php';
event_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the event to delete.',
    ],
], [
    'EVENT_NOT_FOUND' => "An event with the ID doesn't exist.",
]);
