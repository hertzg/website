<?php

include_once '../../../../fns/require_same_domain_referer.php';
require_same_domain_referer('../../..');

include_once '../fns/require_subscribed_channel.php';
include_once '../../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscribed_channel($mysqli);

include_once '../../../../fns/Users/Channels/Users/delete.php';
Users\Channels\Users\delete($mysqli, $subscribedChannel);

$message = 'The user has been removed.';
$_SESSION['notifications/channels/users/messages'] = [$message];

include_once '../../../../fns/redirect.php';
redirect("..?id=$subscribedChannel->id_channels");
