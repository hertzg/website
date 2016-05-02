<?php

include_once '../../../../lib/defaults.php';

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

unset($_SESSION['notifications/subscribed-channels/messages']);

$key = 'notifications/subscribed-channels/subscribe/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['channel_name' => ''];

include_once "$fnsDir/ChannelName/maxLength.php";
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Form/textfield.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'Other Channels',
        'href' => '../#subscribe',
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
        .Form\button('Subscribe')
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'Other Channels', $content, $base);
