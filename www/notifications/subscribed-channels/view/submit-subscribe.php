<?php

include_once '../../../../lib/defaults.php';

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_subscribed_channel.php';
include_once '../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscribed_channel($mysqli);

include_once '../../../fns/SubscribedChannels/setSubscriberLocked.php';
SubscribedChannels\setSubscriberLocked($mysqli, $id, true);

$message = 'Subscribed to this channel.';
$_SESSION['notifications/subscribed-channels/view/messages'] = [$message];

include_once '../../../fns/redirect.php';
redirect("./?id=$id");
