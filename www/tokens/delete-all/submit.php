<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
$user = require_user('../../');
$idusers = $user->idusers;

include_once '../../fns/Tokens/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Tokens\deleteOnUser($mysqli, $idusers);

include_once '../../fns/Users/clearNumTokens.php';
Users\clearNumTokens($mysqli, $idusers);

unset($_SESSION['tokens/errors']);
$_SESSION['tokens/messages'] = [
    'All remembered sessions have been deleted.'
];

include_once '../../fns/redirect.php';
redirect('..');
