<?php

function require_received_file ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Files/Received/get.php";
    $receivedFile = Users\Files\Received\get($mysqli, $user, $id);

    if (!$receivedFile) {
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$receivedFile, $id, $user];

}
