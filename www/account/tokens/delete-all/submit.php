<?php

include_once '../../../../lib/defaults.php';

include_once 'fns/require_tokens.php';
$user = require_tokens();

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once "$fnsDir/Users/Tokens/deleteAll.php";
include_once '../../../lib/mysqli.php';
Users\Tokens\deleteAll($mysqli, $user->id_users);

unset($_SESSION['account/tokens/errors']);
$message = 'All remembered sessions have been deleted.';
$_SESSION['account/tokens/messages'] = [$message];

unset($_SESSION['token']);

include_once "$fnsDir/redirect.php";
redirect('..');
