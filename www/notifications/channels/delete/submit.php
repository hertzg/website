<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

include_once "$fnsDir/Users/Channels/delete.php";
Users\Channels\delete($mysqli, $channel);

unset($_SESSION['notifications/channels/errors']);
$_SESSION['notifications/channels/messages'] = [
    "Channel #$id has been deleted.",
];

include_once "$fnsDir/redirect.php";
redirect('..');
