<?php

namespace Users;

function clearNumNotes ($mysqli, $idusers) {
    $sql = "update users set num_notes = 0 where idusers = $idusers";
    $mysqli->query($sql);
}
