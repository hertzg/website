<?php

function require_received_file ($mysqli) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/ReceivedFiles/getOnReceiver.php";
    $receivedFile = ReceivedFiles\getOnReceiver($mysqli, $user->id_users, $id);

    if (!$receivedFile) {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$receivedFile, $id, $user];

}
