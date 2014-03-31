<?php

include_once '../../fns/require_user.php';
$user = require_user('../');

include_once '../../fns/Users/showTasks.php';
include_once '../../lib/mysqli.php';
Users\showTasks($mysqli, $user->id_users, false);

$_SESSION['customize-home/show-hide/messages'] = [
    '"Tasks" is now hidden.',
];

include_once '../../fns/redirect.php';
redirect();
