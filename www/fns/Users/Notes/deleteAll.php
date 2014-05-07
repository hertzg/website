<?php

namespace Users\Notes;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../Notes/deleteOnUser.php';
    \Notes\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/../../NoteTags/deleteOnUser.php';
    \NoteTags\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_notes = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
