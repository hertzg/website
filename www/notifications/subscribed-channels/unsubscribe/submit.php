<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_public_subscribed_channel.php';
include_once '../../../lib/mysqli.php';
list($subscribed_channel, $id, $user) = require_public_subscribed_channel($mysqli);

include_once '../../../fns/SubscribedChannels/delete.php';
SubscribedChannels\delete($mysqli, $subscribed_channel->id);

include_once '../../../fns/Users/addNumSubscribedChannels.php';
Users\addNumSubscribedChannels($mysqli, $user->id_users, -1);

$_SESSION['notifications/subscribed-channels/messages'] = [
    'Unsubscribed from channel.',
];

include_once '../../../fns/redirect.php';
redirect('..');
