<?php

include_once '../../fns/require_user.php';
$user = require_user('../');

include_once '../../fns/Users/showNotifications.php';
include_once '../../lib/mysqli.php';
Users\showNotifications($mysqli, $user->idusers, true);

$_SESSION['customize-home/show-hide/index_messages'] = array(
    '"Notifications" is now visible.',
);

include_once '../../fns/redirect.php';
redirect();
