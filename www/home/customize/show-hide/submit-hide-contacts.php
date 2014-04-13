<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../fns/require_user.php';
$user = require_user('../../../');

include_once '../../../fns/Users/showContacts.php';
include_once '../../../lib/mysqli.php';
Users\showContacts($mysqli, $user->id_users, false);

$_SESSION['home/customize/show-hide/messages'] = [
    '"Contacts" is now hidden.',
];

include_once '../../../fns/redirect.php';
redirect();
