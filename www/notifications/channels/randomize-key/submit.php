<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

include_once '../../../fns/Channels/randomizeKey.php';
Channels\randomizeKey($mysqli, $user->id_users, $id);

$_SESSION['notifications/channels/view/messages'] = ['Channel key has been randomized.'];

include_once '../../../fns/redirect.php';
redirect("../view/?id=$id");
