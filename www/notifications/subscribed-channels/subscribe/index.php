<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

unset($_SESSION['notifications/subscribed-channels/messages']);

$key = 'notifications/subscribed-channels/subscribe/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['channel_name' => ''];

include_once '../../../fns/ChannelName/maxLength.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
$content = Page\tabs(
    [
        [
            'title' => 'Other Channels',
            'href' => '../#subscribe',
        ],
    ],
    'Subscribe',
    Page\sessionErrors('notifications/subscribed-channels/subscribe/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('channel_name', 'Channel name', [
            'value' => $values['channel_name'],
            'maxlength' => ChannelName\maxLength(),
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Subscribe')
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Other Channels', $content, $base);
