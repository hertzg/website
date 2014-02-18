<?php

include_once '../../lib/sameDomainReferer.php';
include_once '../../fns/redirect.php';
if (!$sameDomainReferer) redirect('../..');

include_once '../fns/require_token.php';
include_once '../../lib/mysqli.php';
list($token, $id) = require_token($mysqli);

include_once '../../fns/Tokens/delete.php';
Tokens\delete($mysqli, $id);

$_SESSION['tokens/index_messages'] = array(
    'Remembered session has been deleted.'
);

redirect('..');
