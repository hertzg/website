<?php

include_once 'fns/require_other_channel.php';
include_once '../../../lib/mysqli.php';
list($channel_user, $id, $user) = require_other_channel($mysqli);

include_once '../../../fns/ChannelUsers/setReceiveNotifications.php';
ChannelUsers\setReceiveNotifications($mysqli, $id, false);

$_SESSION['notifications/other-channels/view/messages'] = [
    'You no longer will receive notifications from this channel.',
];

include_once '../../../fns/redirect.php';
redirect("./?id=$id");
