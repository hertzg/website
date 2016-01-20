<?php

namespace Users\Account\Close;

function deleteNotes ($mysqli, $user) {

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../../..';

    if ($user->num_notes) {

        include_once "$fnsDir/Notes/deleteOnUser.php";
        \Notes\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/NoteTags/deleteOnUser.php";
        \NoteTags\deleteOnUser($mysqli, $id_users);

        include_once "$fnsDir/NoteRevisions/deleteOnUser.php";
        \NoteRevisions\deleteOnUser($mysqli, $id_users);

    }

    if ($user->num_received_notes) {
        include_once "$fnsDir/ReceivedNotes/deleteOnReceiver.php";
        \ReceivedNotes\deleteOnReceiver($mysqli, $id_users);
    }

}
