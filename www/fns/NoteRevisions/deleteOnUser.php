<?php

namespace NoteRevisions;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from note_revisions where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
