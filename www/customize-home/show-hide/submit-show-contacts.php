<?php

include_once '../../fns/require_user.php';
$user = require_user('../');

include_once '../../fns/Users/showContacts.php';
include_once '../../lib/mysqli.php';
Users\showContacts($mysqli, $user->idusers, true);

$_SESSION['customize-home/show-hide/messages'] = array(
    '"Contacts" is now visible.',
);

include_once '../../fns/redirect.php';
redirect();
