<?php

namespace NoteTags;

function deleteOnNote ($mysqli, $id_notes) {
    $mysqli->query("delete from note_tags where id_notes = $id_notes");
}
