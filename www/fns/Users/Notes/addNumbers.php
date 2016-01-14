<?php

namespace Users\Notes;

function addNumbers ($mysqli, $id_users,
    $num_notes, $num_password_protected_notes) {

    $sql = "update users set num_notes = num_notes + $num_notes,"
        .' num_password_protected_notes ='
        ." num_password_protected_notes + $num_password_protected_notes"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
