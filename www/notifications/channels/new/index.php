<?php

include_once '../../../../lib/defaults.php';

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_user.php";
$user = require_user($base);

$key = 'notifications/channels/new/values';
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
    $_SESSION['notifications/channels/messages'],
    $_SESSION['notifications/channels/view/messages']
);

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => 'Channels',
        'href' => '..',
    ],
    'New Channel',
    Page\sessionErrors('notifications/channels/new/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values, $scripts)
        .'<div class="hr"></div>'
        .Form\button('Create')
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, 'New Channel', $content, $base, ['scripts' => $scripts]);
