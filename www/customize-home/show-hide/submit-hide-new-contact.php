<?php

include_once '../../fns/require_user.php';
$user = require_user('../');

include_once '../../fns/Users/showNewContact.php';
include_once '../../lib/mysqli.php';
Users\showNewContact($mysqli, $user->id_users, false);

$_SESSION['customize-home/show-hide/messages'] = [
    '"New Contact" is now hidden.',
];

include_once '../../fns/redirect.php';
redirect();
