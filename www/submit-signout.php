<?php

include_once 'lib/sameDomainReferer.php';
include_once 'fns/redirect.php';
if (!$sameDomainReferer) redirect();
include_once 'lib/session-start.php';
unset($_SESSION['user']);
$_SESSION['signin_messages'] = array(
    'You have been signed out.',
);
redirect('signin.php');
