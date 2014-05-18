<?php

function require_received_file ($mysqli, $id_users) {

    include_once __DIR__.'/../../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../../fns/ReceivedFiles/getOnReceiver.php';
    $receivedFile = ReceivedFiles\getOnReceiver($mysqli, $id_users, $id);

    if (!$receivedFile) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('RECEIVED_FILE_NOT_FOUND');
    }

    return $receivedFile;

}
