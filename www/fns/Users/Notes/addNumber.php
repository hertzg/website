<?php

namespace Users\Notes;

function addNumber ($mysqli, $id_users, $num_notes) {
    $sql = "update users set num_notes = num_notes + $num_notes"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
