<?php

include_once '../fns/notification_method_page.php';
include_once '../../fns/true_result.php';
notification_method_page('post', [
    [
        'name' => 'channel_name',
        'description' => 'The name of the channel in which'
            .' the notification will be posted.',
    ],
    [
        'name' => 'text',
        'description' => 'The text to send.',
    ],
], true_result(), [
    'ENTER_CHANNEL_NAME' => 'The channel name is empty.',
    'INVALID_CHANNEL_NAME' => 'The channel name is invalid.',
    'CHANNEL_NOT_FOUND' => "A channel with the name doesn't exist.",
    'ENTER_TEXT' => 'The text is empty.',
]);
