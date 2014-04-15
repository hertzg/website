<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

include_once '../../../fns/Channels/setPublic.php';
Channels\setPublic($mysqli, $id, true);

$_SESSION['notifications/channels/view/messages'] = [
    'The channel is now public.',
];

include_once '../../../fns/redirect.php';
redirect("./?id=$id");
