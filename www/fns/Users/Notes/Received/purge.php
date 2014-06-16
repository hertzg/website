<?php

namespace Users\Notes\Received;

function purge ($mysqli, $receivedNote) {

    include_once __DIR__.'/../../../ReceivedNotes/delete.php';
    \ReceivedNotes\delete($mysqli, $receivedNote->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receivedNote->receiver_id_users, -1);

}
