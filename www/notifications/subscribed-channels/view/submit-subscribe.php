<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_subscribed_channel.php';
include_once '../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscribed_channel($mysqli);

include_once '../../../fns/SubscribedChannels/setSubscriberLocked.php';
SubscribedChannels\setSubscriberLocked($mysqli, $id, true);

$_SESSION['notifications/subscribed-channels/view/messages'] = [
    'Subscribed to this channel.',
];

include_once '../../../fns/redirect.php';
redirect("./?id=$id");
