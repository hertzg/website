<?php

include_once '../../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../../..');

include_once '../fns/require_subscribed_channel.php';
include_once '../../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscribed_channel($mysqli);

include_once '../../../../fns/Users/Channels/Users/delete.php';
Users\Channels\Users\delete($mysqli, $subscribedChannel);

$_SESSION['notifications/channels/users/messages'] = [
    'The user has been removed.',
];

include_once '../../../../fns/redirect.php';
redirect("..?id=$subscribedChannel->id_channels");
