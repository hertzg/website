<?php

function require_received_note ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../../../fns';

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/ReceivedNotes/getOnReceiver.php";
    $receivedNote = ReceivedNotes\getOnReceiver($mysqli, $id_users, $id);

    if (!$receivedNote) {
        include_once __DIR__.'/../../../fns/bad_request.php';
        bad_request('RECEIVED_NOTE_NOT_FOUND');
    }

    return $receivedNote;

}
