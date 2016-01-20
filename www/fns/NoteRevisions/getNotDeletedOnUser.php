<?php

namespace NoteRevisions;

function getNotDeletedOnUser ($mysqli, $id_users, $id) {
    $sql = 'select * from note_revisions'
        ." where deleted = 0 and id_users = $id_users and id = $id";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);
}
