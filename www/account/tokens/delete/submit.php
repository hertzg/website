<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_token.php';
include_once '../../../lib/mysqli.php';
list($token, $id, $user) = require_token($mysqli);

include_once "$fnsDir/Users/Tokens/delete.php";
Users\Tokens\delete($mysqli, $token);

if (array_key_exists('token', $_SESSION) &&
    $_SESSION['token']->id == $id) unset($_SESSION['token']);

unset($_SESSION['account/tokens/errors']);
$_SESSION['account/tokens/messages'] = [
    "Remembered session #$id has been deleted.",
];

include_once "$fnsDir/redirect.php";
redirect('..');
