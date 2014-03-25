<?php

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id, $user) = require_connection($mysqli);

include_once '../../../fns/Connections/delete.php';
Connections\delete($mysqli, $id);

$_SESSION['account/connections/index_messages'] = [
    'Connection has been deleted.',
];

include_once '../../../fns/redirect.php';
redirect('..');
