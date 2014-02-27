<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/Notifications/deleteAll.php';
include_once '../../lib/mysqli.php';
Notifications\deleteAll($mysqli, $idusers);

include_once '../../fns/Channels/clearNumNotificationsOnUser.php';
Channels\clearNumNotificationsOnUser($mysqli, $idusers);

$_SESSION['notifications/index_messages'] = array(
    'All notifications have been deleted.',
);

include_once '../../fns/redirect.php';
redirect('..');
