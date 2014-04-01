<?php

function require_received_note ($mysqli) {

    include_once __DIR__.'/../../../fns/require_user.php';
    $user = require_user('../../../');

    include_once __DIR__.'/../../../fns/request_strings.php';
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once __DIR__.'/../../../fns/ReceivedNotes/getOnReceiver.php';
    $receivedNote = ReceivedNotes\getOnReceiver($mysqli, $user->id_users, $id);

    if (!$receivedNote) {
        include_once __DIR__.'/../../../fns/redirect.php';
        redirect('..');
    }

    return [$receivedNote, $id, $user];

}
