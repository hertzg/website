<?php

include_once '../fns/event_method_page.php';
include_once '../../fns/true_result.php';
event_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the event to delete.',
    ],
], true_result(), [
    'EVENT_NOT_FOUND' => "An event with the ID doesn't exist.",
]);
