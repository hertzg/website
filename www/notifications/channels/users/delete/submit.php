<?php

include_once '../../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../../..');

include_once '../fns/require_subscribed_channel.php';
include_once '../../../../lib/mysqli.php';
list($subscribed_channel, $id, $user) = require_subscribed_channel($mysqli);

include_once '../../../../fns/SubscribedChannels/delete.php';
SubscribedChannels\delete($mysqli, $id);

include_once '../../../../fns/Users/addNumSubscribedChannels.php';
Users\addNumSubscribedChannels($mysqli, $subscribed_channel->subscribed_id_users, -1);

$_SESSION['channels/users/messages'] = ['The user has been removed.'];

include_once '../../../../fns/redirect.php';
redirect("..?id=$subscribed_channel->id_channels");
