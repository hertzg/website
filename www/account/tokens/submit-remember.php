<?php

include_once '../../../lib/defaults.php';

$fnsDir = '../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('./');

include_once '../fns/require_user_with_password.php';
$user = require_user_with_password('../');

include_once "$fnsDir/request_valid_token.php";
include_once '../../lib/mysqli.php';
$token = request_valid_token($mysqli);

if (!$token) {
    include_once "$fnsDir/Session/remember.php";
    Session\remember($mysqli, $user);
}

unset($_SESSION['account/tokens/errors']);
$_SESSION['account/tokens/messages'] = ['Current session has been remembered.'];

include_once "$fnsDir/redirect.php";
redirect();
