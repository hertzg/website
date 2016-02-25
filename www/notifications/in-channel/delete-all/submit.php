<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once 'fns/require_channel_notifications.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel_notifications($mysqli);

include_once "$fnsDir/Notifications/deleteOnChannel.php";
Notifications\deleteOnChannel($mysqli, $id);

include_once "$fnsDir/Users/Notifications/addNumber.php";
Users\Notifications\addNumber($mysqli, $user->id_users,
    -$channel->num_notifications);

include_once "$fnsDir/Channels/clearNumNotifications.php";
Channels\clearNumNotifications($mysqli, $id);

unset($_SESSION['notifications/errors']);
$message = 'Notifications have been deleted.';
$_SESSION['notifications/in-channel/messages'] = [$message];

include_once "$fnsDir/redirect.php";
redirect("../?id=$id");
