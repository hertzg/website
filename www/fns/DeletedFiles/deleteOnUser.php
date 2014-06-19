<?php

namespace DeletedFiles;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from deleted_files where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
