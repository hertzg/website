<?php

namespace NoteTags;

function deleteOnUser ($mysqli, $idusers) {
    $mysqli->query("delete from note_tags where idusers = $idusers");
}
