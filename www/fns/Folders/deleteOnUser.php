<?php

namespace Folders;

function deleteOnUser ($mysqli, $id_users) {
    $sql = "delete from folders where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
