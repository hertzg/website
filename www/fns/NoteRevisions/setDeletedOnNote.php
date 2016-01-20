<?php

namespace NoteRevisions;

function setDeletedOnNote ($mysqli, $id_notes, $deleted) {
    $deleted = $deleted ? '1' : '0';
    $sql = "update note_revisions set deleted = $deleted"
        ." where id_notes = $id_notes";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
