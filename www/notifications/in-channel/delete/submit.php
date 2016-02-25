<?php

include_once '../../../../lib/defaults.php';

$base = '../../../';
$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('../..');

include_once '../../fns/require_notification.php';
include_once '../../../lib/mysqli.php';
list($notification, $id, $user) = require_notification($mysqli, '../');

include_once "$fnsDir/Users/Notifications/delete.php";
Users\Notifications\delete($mysqli, $notification);

$_SESSION['notifications/in-channel/messages'] = [
    'The notification has been deleted.',
];

include_once "$fnsDir/redirect.php";
include_once "$fnsDir/ItemList/itemQuery.php";
redirect('../'.ItemList\itemQuery($notification->id_channels));
