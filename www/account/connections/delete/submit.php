<?php

include_once '../../../fns/require_same_domain_referer.php';
require_same_domain_referer('..');

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

include_once '../../../fns/Connections/delete.php';
Connections\delete($mysqli, $id);

$_SESSION['account/connections/messages'] = [
    'Connection has been deleted.',
];

include_once '../../../fns/redirect.php';
redirect('..');
