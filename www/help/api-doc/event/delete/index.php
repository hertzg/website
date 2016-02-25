<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/event_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
event_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the event to delete.',
    ],
], ApiDoc\trueResult(), [
    'EVENT_NOT_FOUND' => "An event with the ID doesn't exist.",
]);
