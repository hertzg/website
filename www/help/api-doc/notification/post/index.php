<?php

include_once '../fns/notification_method_page.php';
notification_method_page('post', [
    [
        'name' => 'channel_name',
        'description' => 'The name of the channel in which'
            .' the notification will be published.',
    ],
    [
        'name' => 'notification_text',
        'description' => 'The text to send.',
    ],
], ['CHANNEL_NOT_FOUND', 'ENTER_NOTIFICATION_TEXT']);
