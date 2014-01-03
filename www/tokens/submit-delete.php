<?php

include_once '../lib/sameDomainReferer.php';
include_once '../fns/redirect.php';
if (!$sameDomainReferer) redirect('..');
include_once 'lib/require-token.php';

include_once '../classes/Tokens.php';
Tokens::delete($id);

$_SESSION['tokens/index_messages'] = array('Remembered session has been deleted.');

redirect();
