<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../fns/require_user.php';
$user = require_user('../../../');

include_once '../../../fns/Users/Tokens/deleteAll.php';
include_once '../../../lib/mysqli.php';
Users\Tokens\deleteAll($mysqli, $user->id_users);

unset($_SESSION['account/tokens/errors']);
$_SESSION['account/tokens/messages'] = ['All remembered sessions have been deleted.'];

include_once '../../../fns/redirect.php';
redirect('..');
