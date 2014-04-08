<?php

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

include_once '../../../fns/Channels/setReceiveNotifications.php';
Channels\setReceiveNotifications($mysqli, $id, false);

$_SESSION['notifications/channels/view/messages'] = [
    'You no longer will receive notifications from this channel.',
];

include_once '../../../fns/redirect.php';
redirect("./?id=$id");
