<?php

namespace NoteTags;

function deleteOnNote ($mysqli, $idnotes) {
    $mysqli->query("delete from note_tags where idnotes = $idnotes");
}
