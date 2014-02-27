<?php

namespace Users;

function addNumNotes ($mysqli, $idusers, $num_notes) {
    $sql = "update users set num_notes = num_notes + $num_notes"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
