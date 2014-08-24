<?php

include_once '../fns/notification_method_page.php';
notification_method_page('post', [
    [
        'name' => 'channel_name',
        'description' => 'The name of the channel in which'
            .' the notification will be published.',
    ],
    [
        'name' => 'text',
        'description' => 'The text to send.',
    ],
], [
    'CHANNEL_NOT_FOUND' => "A channel with the name doesn't exist.",
    'ENTER_TEXT' => 'The text is empty.',
]);
