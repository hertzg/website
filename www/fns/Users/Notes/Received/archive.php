<?php

namespace Users\Notes\Received;

function archive ($mysqli, $receivedNote) {
    if (!$receivedNote->archived) {

        include_once __DIR__.'/../../../ReceivedNotes/setArchived.php';
        \ReceivedNotes\setArchived($mysqli, $receivedNote->id, true);

        include_once __DIR__.'/addNumberArchived.php';
        addNumberArchived($mysqli, $receivedNote->receiver_id_users, 1);

    }
}
