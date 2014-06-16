<?php

namespace Users\Notes\Received;

function delete ($mysqli, $receivedNote) {

    include_once __DIR__.'/purge.php';
    purge($mysqli, $receivedNote);

    include_once __DIR__.'/../../DeletedItems/addReceivedNote.php';
    \Users\DeletedItems\addReceivedNote($mysqli, $receivedNote);

}
