<?php

include_once '../../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../../..');

include_once 'fns/require_nonpublic_subscribed_channel.php';
include_once '../../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_nonpublic_subscribed_channel($mysqli);

include_once '../../../../fns/SubscribedChannels/delete.php';
SubscribedChannels\delete($mysqli, $id);

include_once '../../../../fns/Users/addNumSubscribedChannels.php';
Users\addNumSubscribedChannels($mysqli, $subscribedChannel->subscriber_id_users, -1);

$_SESSION['notifications/channels/users/messages'] = [
    'The user has been removed.',
];

include_once '../../../../fns/redirect.php';
redirect("..?id=$subscribedChannel->id_channels");
