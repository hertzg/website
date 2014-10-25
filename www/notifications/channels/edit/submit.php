<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

include_once '../fns/request_channel_params.php';
$values = request_channel_params($mysqli, $errors, $channel->id);
list($channel_name, $public, $receive_notifications) = $values;

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['notifications/channels/edit/errors'] = $errors;
    $_SESSION['notifications/channels/edit/values'] = [
        'channel_name' => $channel_name,
        'public' => $public,
        'receive_notifications' => $receive_notifications,
    ];
    redirect("./?id=$id");
}

unset(
    $_SESSION['notifications/channels/edit/errors'],
    $_SESSION['notifications/channels/edit/values']
);

include_once "$fnsDir/Users/Channels/edit.php";
Users\Channels\edit($mysqli, $id, $channel_name,
    $public, $receive_notifications);

$message = 'Changes have been saved.';
$_SESSION['notifications/channels/view/messages'] = [$message];

redirect("../view/?id=$id");
