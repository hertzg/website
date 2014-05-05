<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_channel.php';
include_once '../../../lib/mysqli.php';
list($channel, $id, $user) = require_channel($mysqli);

include_once '../../../fns/Users/Channels/delete.php';
Users\Channels\delete($mysqli, $id, $user->id_users);

unset($_SESSION['notifications/channels/errors']);
$_SESSION['notifications/channels/messages'] = ['Channel has been deleted.'];

include_once '../../../fns/redirect.php';
redirect('..');
