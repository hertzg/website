<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../../');

include_once '../fns/request_channel_params.php';
include_once '../../../lib/mysqli.php';
list($channel_name, $public,
    $receive_notifications) = request_channel_params($mysqli, $errors);

include_once "$fnsDir/redirect.php";

if ($errors) {
    $_SESSION['notifications/channels/new/errors'] = $errors;
    $_SESSION['notifications/channels/new/values'] = [
        'channel_name' => $channel_name,
        'public' => $public,
        'receive_notifications' => $receive_notifications,
    ];
    redirect();
}

unset(
    $_SESSION['notifications/channels/new/errors'],
    $_SESSION['notifications/channels/new/values']
);

include_once "$fnsDir/Users/Channels/add.php";
$id = Users\Channels\add($mysqli, $user,
    $channel_name, $public, $receive_notifications);

$_SESSION['notifications/channels/view/messages'] = [
    'Channel has been saved.',
];

redirect("../view/?id=$id");
