<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli, '../..');

include_once '../../../fns/Notifications/deleteOnChannel.php';
Notifications\deleteOnChannel($mysqli, $id);

include_once '../../../fns/Users/Notifications/addNumber.php';
Users\Notifications\addNumber($mysqli, $user->id_users,
    -$channel->num_notifications);

include_once '../../../fns/Channels/clearNumNotifications.php';
Channels\clearNumNotifications($mysqli, $id);

unset($_SESSION['notifications/errors']);
$_SESSION['notifications/in-channel/messages'] = [
    'Notifications have been deleted.',
];

include_once '../../../fns/redirect.php';
redirect("../?id=$id");
