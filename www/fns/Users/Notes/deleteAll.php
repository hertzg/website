<?php

namespace Users\Notes;

function deleteAll ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Notes/indexOnUser.php";
    $notes = \Notes\indexOnUser($mysqli, $id_users);

    if ($notes) {
        include_once "$fnsDir/DeletedItems/Notes/add.php";
        foreach ($notes as $note) {
            \DeletedItems\Notes\add($mysqli, $note);
        }
    }

    include_once "$fnsDir/Notes/deleteOnUser.php";
    \Notes\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/NoteTags/deleteOnUser.php";
    \NoteTags\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_notes = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
