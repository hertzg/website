<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_channel.php';
include_once '../../lib/mysqli.php';
list($channel, $id) = require_channel($mysqli);

include_once '../../fns/Notifications/deleteOnChannel.php';
Notifications\deleteOnChannel($mysqli, $id);

include_once '../../fns/Channels/delete.php';
Channels\delete($mysqli, $id);

include_once '../../fns/Users/addNumChannels.php';
Users\addNumChannels($mysqli, $idusers, -1);

$_SESSION['channels/index_messages'] = array('Channel has been deleted.');

include_once '../../fns/redirect.php';
redirect('..');
