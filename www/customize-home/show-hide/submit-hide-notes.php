<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../');

include_once '../../fns/Users/showNotes.php';
include_once '../../lib/mysqli.php';
Users\showNotes($mysqli, $user->id_users, false);

$_SESSION['customize-home/show-hide/messages'] = [
    '"Notes" is now hidden.',
];

include_once '../../fns/redirect.php';
redirect();
