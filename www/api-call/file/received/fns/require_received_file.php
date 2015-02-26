<?php

function require_received_file ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Files/Received/get.php";
    $receivedFile = Users\Files\Received\get($mysqli, $user, $id);

    if (!$receivedFile) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('RECEIVED_FILE_NOT_FOUND');
    }

    return $receivedFile;

}
