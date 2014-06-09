<?php

function require_received_note ($mysqli) {

    $fnsDir = __DIR__.'/../../../fns';

    include_once "$fnsDir/require_user.php";
    $user = require_user('../../../');

    include_once "$fnsDir/request_strings.php";
    list($id) = request_strings('id');

    $id = abs((int)$id);

    include_once "$fnsDir/ReceivedNotes/getOnReceiver.php";
    $receivedNote = ReceivedNotes\getOnReceiver($mysqli, $user->id_users, $id);

    if (!$receivedNote) {
        include_once "$fnsDir/redirect.php";
        redirect('..');
    }

    return [$receivedNote, $id, $user];

}
