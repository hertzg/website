<?php

include_once '../../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../../..');

include_once '../fns/require_subscribed_channel.php';
include_once '../../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscribed_channel($mysqli);

if ($subscribedChannel->subscriber_locked) {
    include_once '../../../../fns/SubscribedChannels/setPublisherLocked.php';
    SubscribedChannels\setPublisherLocked($mysqli, $id, false);
} else {

    include_once '../../../../fns/SubscribedChannels/delete.php';
    SubscribedChannels\delete($mysqli, $id);

    include_once '../../../../fns/Users/SubscribedChannels/addNumber.php';
    Users\SubscribedChannels\addNumber($mysqli, $subscribedChannel->subscriber_id_users, -1);

}

$id_channels = $subscribedChannel->id_channels;

include_once '../../../../fns/Channels/addNumUsers.php';
Channels\addNumUsers($mysqli, $id_channels, -1);

$_SESSION['notifications/channels/users/messages'] = [
    'The user has been removed.',
];

include_once '../../../../fns/redirect.php';
redirect("..?id=$id_channels");
