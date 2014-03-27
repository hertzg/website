<?php

include_once 'fns/require_other_channel.php';
include_once '../../../lib/mysqli.php';
list($channel_user, $id, $user) = require_other_channel($mysqli);

include_once '../../../fns/ChannelUsers/setReceiveNotifications.php';
ChannelUsers\setReceiveNotifications($mysqli, $id, true);

$_SESSION['notifications/other-channels/view/messages'] = [
    'You will receive notifications from this channel.',
];

include_once '../../../fns/redirect.php';
redirect("./?id=$id");
