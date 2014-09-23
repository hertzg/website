<?php

$base = '../../../';

include_once '../../../fns/require_user.php';
$user = require_user($base);

$key = 'notifications/channels/add/values';
if (array_key_exists($key, $_SESSION)) {
    $values = $_SESSION[$key];
} else {
    $values = [
        'channel_name' => '',
        'public' => false,
        'receive_notifications' => false,
    ];
}

unset(
    $_SESSION['notifications/channels/errors'],
    $_SESSION['notifications/channels/messages']
);

include_once '../fns/create_form_items.php';
include_once '../../../fns/compressed_js_script.php';
include_once '../../../fns/Form/button.php';
include_once '../../../fns/Page/sessionErrors.php';
include_once '../../../fns/Page/tabs.php';
$content =
    Page\tabs(
        [
            [
                'title' => 'Channels',
                'href' => '..',
            ],
        ],
        'New',
        Page\sessionErrors('notifications/channels/add/errors')
        .'<form action="submit.php" method="post">'
            .create_form_items($values)
            .'<div class="hr"></div>'
            .Form\button('Create')
        .'</form>'
    )
    .compressed_js_script('formCheckbox', $base);

include_once '../../../fns/echo_page.php';
echo_page($user, 'New Channel', $content, $base);
