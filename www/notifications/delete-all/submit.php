<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'lib/require-user.php';

include_once '../../fns/Notifications/deleteAll.php';
include_once '../../lib/mysqli.php';
Notifications\deleteAll($mysqli, $idusers);

include_once '../../fns/Channels/clearNumNotificationsOnUser.php';
Channels\clearNumNotificationsOnUser($mysqli, $idusers);

$_SESSION['notifications/index_messages'] = array(
    'All notifications have been deleted.',
);

redirect('..');
