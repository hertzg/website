<?php

namespace NoteRevisions;

function deleteOnNote ($mysqli, $id_notes) {
    $sql = "delete from note_revisions where id_notes = $id_notes";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
