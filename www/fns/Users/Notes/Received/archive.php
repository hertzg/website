<?php

namespace Users\Notes\Received;

function archive ($mysqli, $receivedNote) {

    if ($receivedNote->archived) return;

    include_once __DIR__.'/../../../ReceivedNotes/setArchived.php';
    \ReceivedNotes\setArchived($mysqli, $receivedNote->id, true);

    include_once __DIR__.'/addNumbers.php';
    addNumbers($mysqli, $receivedNote->receiver_id_users, 0, 1);

}
