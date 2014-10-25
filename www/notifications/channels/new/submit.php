<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../../');

include_once '../fns/request_channel_params.php';
include_once '../../../lib/mysqli.php';
$values = request_channel_params($mysqli, $errors);
list($channel_name, $public, $receive_notifications) = $values;

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['notifications/channels/add/errors'] = $errors;
    $_SESSION['notifications/channels/add/values'] = [
        'channel_name' => $channel_name,
        'public' => $public,
        'receive_notifications' => $receive_notifications,
    ];
    redirect();
}

unset(
    $_SESSION['notifications/channels/add/errors'],
    $_SESSION['notifications/channels/add/values']
);

include_once "$fnsDir/Users/Channels/add.php";
$id = Users\Channels\add($mysqli, $user,
    $channel_name, $public, $receive_notifications);

$message = 'Channel has been created.';
$_SESSION['notifications/channels/view/messages'] = [$message];

redirect("../view/?id=$id");
