<?php

namespace Users\Notes\Received;

function unarchive ($mysqli, $receivedNote) {

    if (!$receivedNote->archived) return;

    include_once __DIR__.'/../../../ReceivedNotes/setArchived.php';
    \ReceivedNotes\setArchived($mysqli, $receivedNote->id, false);

    include_once __DIR__.'/addNumberArchived.php';
    addNumberArchived($mysqli, $receivedNote->receiver_id_users, -1);

}
