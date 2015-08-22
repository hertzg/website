<?php

include_once '../fns/notification_method_page.php';
include_once '../../fns/true_result.php';
notification_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the notification to delete.',
    ],
], true_result(), [
    'NOTIFICATION_NOT_FOUND' => "A notification with the ID doesn't exist.",
]);
