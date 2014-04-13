<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../fns/require_user.php';
$user = require_user('../../../');

include_once '../../../fns/Users/showNewBookmark.php';
include_once '../../../lib/mysqli.php';
Users\showNewBookmark($mysqli, $user->id_users, true);

$_SESSION['home/customize/show-hide/messages'] = [
    '"New Bookmark" is now visible.',
];

include_once '../../../fns/redirect.php';
redirect();
