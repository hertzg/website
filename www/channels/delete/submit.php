<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');
include_once 'lib/require-channel.php';

include_once '../../fns/Notifications/deleteOnChannel.php';
include_once '../../lib/mysqli.php';
Notifications\deleteOnChannel($mysqli, $id);

include_once '../../fns/Users/addNumNotifications.php';
Users\addNumNotifications($mysqli, $idusers, -$channel->numnotifications);

include_once '../../fns/Channels/delete.php';
Channels\delete($mysqli, $id);

$_SESSION['channels/index_messages'] = array('Channel has been deleted.');

redirect('..');
