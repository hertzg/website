<?php

namespace Users;

function clearNumNotes ($mysqli, $id_users) {
    $sql = "update users set num_notes = 0 where id_users = $id_users";
    $mysqli->query($sql);
}
