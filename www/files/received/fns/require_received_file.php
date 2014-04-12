<?php

function require_received_file ($mysqli) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user('../../../');

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/ReceivedFiles/getOnReceiver.php';
    $receivedFile = ReceivedFiles\getOnReceiver($mysqli, $user->id_users, $id);

    if (!$receivedFile) {
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect('..');
    }

    return [$receivedFile, $id, $user];

}
