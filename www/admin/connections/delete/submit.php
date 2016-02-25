<?php

include_once '../../../../lib/defaults.php';

$fnsDir = '../../../fns';

include_once "$fnsDir/require_same_domain_referer.php";
require_same_domain_referer('..');

include_once '../fns/require_connection.php';
include_once '../../../lib/mysqli.php';
list($connection, $id) = require_connection($mysqli, '../');

include_once "$fnsDir/AdminConnections/delete.php";
AdminConnections\delete($mysqli, $id);

include_once "$fnsDir/AdminConnectionAuths/deleteOnAdminConnection.php";
AdminConnectionAuths\deleteOnAdminConnection($mysqli, $id);

unset($_SESSION['admin/connections/errors']);
$_SESSION['admin/connections/messages'] = [
    "Connection #$id has been deleted.",
];

include_once "$fnsDir/redirect.php";
redirect('..');
