<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

include_once '../../../fns/Users/Connections/delete.php';
Users\Connections\delete($mysqli, $connection);

$_SESSION['account/connections/messages'] = [
    'Connection has been deleted.',
];
unset($_SESSION['account/connections/errors']);

include_once '../../../fns/redirect.php';
redirect('..');
