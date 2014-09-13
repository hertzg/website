<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../fns/require_token.php';
include_once '../../../lib/mysqli.php';
list($token, $id, $user) = require_token($mysqli);

include_once '../../../fns/Users/Tokens/delete.php';
Users\Tokens\delete($mysqli, $token);

unset($_SESSION['tokens/errors']);
$_SESSION['tokens/messages'] = ['Remembered session has been deleted.'];

include_once '../../../fns/redirect.php';
redirect('..');
