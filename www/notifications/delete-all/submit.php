<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$idusers = $user->idusers;

include_once '../../fns/Notifications/deleteAll.php';
include_once '../../lib/mysqli.php';
Notifications\deleteAll($mysqli, $idusers);

include_once '../../fns/Users/clearNumNotifications.php';
Users\clearNumNotifications($mysqli, $idusers);

unset($_SESSION['notifications/errors']);
$_SESSION['notifications/messages'] = array(
    'All notifications have been deleted.',
);

include_once '../../fns/redirect.php';
redirect('..');
