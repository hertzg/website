<?php

function require_received_folder ($mysqli, $base = '') {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user("$base../../../");

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/files/received/get.php";
    $receivedFolder = Users\Folders\Received\get($mysqli, $user, $id);

    if (!$receivedFolder) {
        unset($_SESSION['files/received/messages']);
        $error = 'The received folder no longer exists.';
        $_SESSION['files/received/errors'] = [$error];
        include_once "$fnsDir/redirect.php";
        redirect("$base..");
    }

    return [$receivedFolder, $id, $user];

}
