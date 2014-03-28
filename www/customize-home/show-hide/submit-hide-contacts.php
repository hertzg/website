<?php

include_once '../../fns/require_user.php';
$user = require_user('../');

include_once '../../fns/Users/showContacts.php';
include_once '../../lib/mysqli.php';
Users\showContacts($mysqli, $user->idusers, false);

$_SESSION['customize-home/show-hide/messages'] = [
    '"Contacts" is now hidden.',
];

include_once '../../fns/redirect.php';
redirect();
