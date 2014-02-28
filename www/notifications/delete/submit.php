<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once 'fns/require_channel.php';
include_once '../../lib/mysqli.php';
list($channel, $id) = require_channel($mysqli);

include_once '../../fns/Notifications/deleteOnChannel.php';
Notifications\deleteOnChannel($mysqli, $id);

include_once '../../fns/Channels/addNumNotifications.php';
Channels\addNumNotifications($mysqli, $id, -$channel->num_notifications);

include_once '../../fns/Users/clearNumNotifications.php';
Users\clearNumNotifications($mysqli, $idusers);

$_SESSION['notifications/index_messages'] = array(
    'Notifications have been deleted.',
);

include_once '../../fns/redirect.php';
redirect('..');
