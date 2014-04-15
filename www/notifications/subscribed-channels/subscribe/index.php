<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

$key = 'notifications/subscribed-channels/subscribe/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else $values = ['channel_name' => ''];

include_once '../../../fns/create_tabs.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Form/textfield.php';
include_once '../../../fns/Page/sessionErrors.php';
$content = create_tabs(
    [
        [
            'title' => '&middot;&middot;&middot;',
            'href' => '../..',
        ],
        [
            'title' => 'Other Channels',
            'href' => '..',
        ],
    ],
    'Subscribe',
    Page\sessionErrors('notifications/subscribed-channels/subscribe/errors')
    .'<form action="submit.php" method="post">'
        .Form\textfield('channel_name', 'Channel name', [
            'value' => $values['channel_name'],
            'required' => true,
            'autofocus' => true,
        ])
        .'<div class="hr"></div>'
        .Form\button('Subscribe')
    .'</form>'
);

include_once '../../../fns/echo_page.php';
echo_page($user, 'Other Channels', $content, $base);
