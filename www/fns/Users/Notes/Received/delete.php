<?php

namespace Users\Notes\Received;

function delete ($mysqli, $receivedNote) {

    include_once __DIR__.'/../../../ReceivedNotes/delete.php';
    \ReceivedNotes\delete($mysqli, $receivedNote->id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $receivedNote->receiver_id_users, -1);

    include_once __DIR__.'/../../DeletedItems/addReceivedNote.php';
    \Users\DeletedItems\addReceivedNote($mysqli, $receivedNote);

}
