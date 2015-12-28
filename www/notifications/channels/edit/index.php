<?php

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

$key = 'notifications/channels/edit/values';
if (array_key_exists($key, $_SESSION)) $values = $_SESSION[$key];
else {
    $values = [
        'channel_name' => $channel->channel_name,
        'public' => $channel->public,
        'receive_notifications' => $channel->receive_notifications,
    ];
}

unset($_SESSION['notifications/channels/view/messages']);

$fnsDir = '../../../fns';

include_once '../fns/create_form_items.php';
include_once "$fnsDir/Form/button.php";
include_once "$fnsDir/Page/create.php";
include_once "$fnsDir/Page/sessionErrors.php";
$content = Page\create(
    [
        'title' => "Channel #$id",
        'href' => "../view/?id=$id#edit",
    ],
    'Edit',
    Page\sessionErrors('notifications/channels/edit/errors')
    .'<form action="submit.php" method="post">'
        .create_form_items($values, $scripts)
        .'<div class="hr"></div>'
        .Form\button('Save Channel')
        ."<input type=\"hidden\" name=\"id\" value=\"$id\" />"
    .'</form>'
);

include_once "$fnsDir/echo_user_page.php";
echo_user_page($user, "Edit Channel #$id",
    $content, '../../../', ['scripts' => $scripts]);
