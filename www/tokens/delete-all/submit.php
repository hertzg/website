<?php

include_once '../../fns/require_same_domain_referer.php';
require_same_domain_referer('./');

include_once '../../fns/require_user.php';
require_user('../../');

include_once '../../fns/Tokens/deleteOnUser.php';
include_once '../../lib/mysqli.php';
Tokens\deleteOnUser($mysqli, $idusers);

include_once '../../fns/Users/clearNumTokens.php';
Users\clearNumTokens($mysqli, $idusers);

$_SESSION['tokens/index_messages'] = array(
    'All remembered sessions have been deleted.'
);

include_once '../../fns/redirect.php';
redirect('..');
