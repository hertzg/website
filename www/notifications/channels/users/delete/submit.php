<?php

$fnsDir = '../../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../../..');

include_once '../fns/require_subscribed_channel.php';
include_once '../../../../lib/mysqli.php';
list($subscribedChannel, $id, $user) = require_subscribed_channel($mysqli);

include_once "$fnsDir/Users/Channels/Users/delete.php";
Users\Channels\Users\delete($mysqli, $subscribedChannel);

$message = 'The user has been removed.';
$_SESSION['notifications/channels/users/messages'] = [$message];

include_once "$fnsDir/redirect.php";
redirect("..?id=$subscribedChannel->id_channels");
