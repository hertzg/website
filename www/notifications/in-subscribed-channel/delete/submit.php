<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../..');

include_once '../fns/require_subscribed_channel.php';
include_once '../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscribed_channel($mysqli, '../..');

include_once '../../../fns/Notifications/deleteOnSubscribedChannel.php';
Notifications\deleteOnSubscribedChannel($mysqli, $id);

include_once '../../../fns/Users/Notifications/addNumber.php';
Users\Notifications\addNumber($mysqli, $user->id_users,
    -$subscribedChannel->num_notifications);

include_once '../../fns/SubscribedChannels/clearNumNotifications.php';
SubscribedChannels\clearNumNotifications($mysqli, $id);

unset($_SESSION['notifications/errors']);
$_SESSION['notifications/in-subscribed-channel/messages'] = [
    'Notifications have been deleted.',
];

include_once '../../../fns/redirect.php';
redirect("../?id=$id");
