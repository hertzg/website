<?php

namespace Users\Notes\Received;

function purge ($mysqli, $receivedNote) {

    include_once __DIR__.'/../../../ReceivedNotes/delete.php';
    \ReceivedNotes\delete($mysqli, $receivedNote->id);

    $id_users = $receivedNote->receiver_id_users;

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

    if ($receivedNote->archived) {
        include_once __DIR__.'/addNumberArchived.php';
        addNumberArchived($mysqli, $id_users, -1);
    }

}
