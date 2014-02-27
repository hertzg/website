<?php

namespace NoteTags;

function deleteOnNote ($mysqli, $idnotes) {
    $mysqli->query("delete from notetags where idnotes = $idnotes");
}
