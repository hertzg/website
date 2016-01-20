<?php

namespace Users\Notes;

function deleteAll ($mysqli, $user, $apiKey = null) {

    if (!$user->num_notes) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Notes/indexOnUser.php";
    $notes = \Notes\indexOnUser($mysqli, $id_users);

    if ($notes) {
        include_once __DIR__.'/../DeletedItems/addNote.php';
        foreach ($notes as $note) {
            \Users\DeletedItems\addNote($mysqli, $note, $apiKey);
        }
    }

    include_once "$fnsDir/Notes/deleteOnUser.php";
    \Notes\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/NoteRevisions/setDeletedOnUser.php";
    \NoteRevisions\setDeletedOnUser($mysqli, $id_users, true);

    include_once "$fnsDir/NoteTags/deleteOnUser.php";
    \NoteTags\deleteOnUser($mysqli, $id_users);

    $sql = 'update users set num_notes = 0,'
        ." num_password_protected_notes = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
