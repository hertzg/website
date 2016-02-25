<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once 'fns/require_subscribed_channel_notifications.php';
include_once '../../../lib/mysqli.php';
$values = require_subscribed_channel_notifications($mysqli);
list($subscribedChannel, $id, $user) = $values;

include_once "$fnsDir/Notifications/deleteOnSubscribedChannel.php";
Notifications\deleteOnSubscribedChannel($mysqli, $id);

include_once "$fnsDir/Users/Notifications/addNumber.php";
Users\Notifications\addNumber($mysqli, $user->id_users,
    -$subscribedChannel->num_notifications);

include_once "$fnsDir/SubscribedChannels/clearNumNotifications.php";
SubscribedChannels\clearNumNotifications($mysqli, $id);

unset($_SESSION['notifications/errors']);
$message = 'Notifications have been deleted.';
$_SESSION['notifications/in-subscribed-channel/messages'] = [$message];

include_once "$fnsDir/redirect.php";
redirect("../?id=$id");
