<?php

function require_connection ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once __DIR__.'/../../fns/require_admin.php';
    $admin_user = require_admin();

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/AdminConnections/get.php";
    $connection = AdminConnections\get($mysqli, $id);

    if (!$connection) {
        $error = 'The connection no longer exists.';
        $_SESSION['admin/connections/errors'] = [$error];
        unset($_SESSION['admin/connections/messages']);
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$connection, $id, $admin_user];

}
