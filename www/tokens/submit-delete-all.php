<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');

include_once 'lib/require-user.php';
include_once '../classes/Tokens.php';
Tokens::deleteOnUser($idusers);

$_SESSION['tokens/index_messages'] = array(
    'All remembered sessions have been deleted.'
);

redirect();
