<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../../fns/require_user.php';
$user = require_user('../../../');
$id_users = $user->id_users;

include_once '../../../fns/Tokens/deleteOnUser.php';
include_once '../../../lib/mysqli.php';
Tokens\deleteOnUser($mysqli, $id_users);

include_once '../../../fns/Users/Tokens/clearNumber.php';
Users\Tokens\clearNumber($mysqli, $id_users);

unset($_SESSION['tokens/errors']);
$_SESSION['tokens/messages'] = ['All remembered sessions have been deleted.'];

include_once '../../../fns/redirect.php';
redirect('..');
