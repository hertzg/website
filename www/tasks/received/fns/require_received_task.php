<?php

function require_received_task ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Tasks/Received/get.php";
    $receivedTask = Users\Tasks\Received\get($mysqli, $user, $id);

    if (!$receivedTask) {
        include_once "$fnsDir/redirect.php";
        redirect("$base./");
    }

    return [$receivedTask, $id, $user];

}
