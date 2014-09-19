<?php

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/require_user.php";
$user = require_user('../../../');

include_once "$fnsDir/Users/Tokens/deleteAll.php";
include_once '../../../lib/mysqli.php';
Users\Tokens\deleteAll($mysqli, $user->id_users);

unset($_SESSION['account/tokens/errors']);
$message = 'All remembered sessions have been deleted.';
$_SESSION['account/tokens/messages'] = [$message];

include_once "$fnsDir/redirect.php";
redirect('..');
