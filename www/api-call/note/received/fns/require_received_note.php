<?php

function require_received_note ($mysqli, $user) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/Users/Notes/Received/get.php";
    $receivedNote = Users\Notes\Received\get($mysqli, $user, $id);

    if (!$receivedNote) {
        include_once "$fnsDir/ApiCall/Error/badRequest.php";
        ApiCall\Error\badRequest('"RECEIVED_NOTE_NOT_FOUND"');
    }

    return $receivedNote;

}
