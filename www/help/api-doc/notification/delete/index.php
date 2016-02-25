<?php

include_once '../../../../../lib/defaults.php';

include_once '../fns/notification_method_page.php';
include_once '../../../../fns/ApiDoc/trueResult.php';
notification_method_page('delete', [
    [
        'name' => 'id',
        'description' => 'The ID of the notification to delete.',
    ],
], ApiDoc\trueResult(), [
    'NOTIFICATION_NOT_FOUND' => "A notification with the ID doesn't exist.",
]);
