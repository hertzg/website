<?php

namespace Users;

function addNumReceivedNotes ($mysqli, $id_users, $n) {
    $sql = "update users set num_received_notes = num_received_notes + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql);
}
