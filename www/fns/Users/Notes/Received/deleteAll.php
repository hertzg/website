<?php

namespace Users\Notes\Received;

function deleteAll ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../../..';

    include_once "$fnsDir/ReceivedNotes/indexOnReceiver.php";
    $receivedNotes = \ReceivedNotes\indexOnReceiver($mysqli, $id_users);

    if ($receivedNotes) {
        include_once __DIR__.'/../../DeletedItems/addReceivedNote.php';
        foreach ($receivedNotes as $receivedNote) {
            \Users\DeletedItems\addReceivedNote($mysqli, $receivedNote);
        }
    }

    include_once "$fnsDir/ReceivedNotes/deleteOnReceiver.php";
    \ReceivedNotes\deleteOnReceiver($mysqli, $id_users);

    $sql = 'update users set num_received_notes = 0,'
        .' num_archived_received_notes = 0'
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
