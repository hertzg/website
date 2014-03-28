<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);
$idusers = $user->idusers;

include_once '../../../fns/Notifications/deleteOnChannel.php';
Notifications\deleteOnChannel($mysqli, $id);

include_once '../../../fns/Channels/delete.php';
Channels\delete($mysqli, $id);

include_once '../../../fns/Users/addNumChannels.php';
Users\addNumChannels($mysqli, $idusers, -1);

include_once '../../../fns/Users/clearNumNotifications.php';
Users\clearNumNotifications($mysqli, $idusers);

unset($_SESSION['notifications/channels/errors']);
$_SESSION['notifications/channels/messages'] = ['Channel has been deleted.'];

include_once '../../../fns/redirect.php';
redirect('..');
