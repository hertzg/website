<?php

include_once 'fns/require_admin_connection.php';
require_admin_connection($adminConnection, $mysqli);

header('Content-Type: application/json');
echo 'true';
