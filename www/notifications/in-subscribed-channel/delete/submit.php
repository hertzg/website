<?php

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../../fns/require_notification.php';
include_once '../../../lib/mysqli.php';
list($notification, $id, $user) = require_notification($mysqli);

include_once "$fnsDir/Users/Notifications/delete.php";
Users\Notifications\delete($mysqli, $notification);

$message = 'The notification has been deleted.';
$_SESSION['notifications/in-subscribed-channel/messages'] = [$message];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../'.ItemList\itemQuery($notification->id_subscribed_channels));
