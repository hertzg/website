<?php

namespace NoteTags;

function deleteOnNote ($mysqli, $id_notes) {
    $sql = "delete from note_tags where id_notes = $id_notes";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
