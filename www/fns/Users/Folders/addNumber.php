<?php

namespace Users\Folders;

function addNumber ($mysqli, $id_users, $num_folders) {
    $sql = "update users set num_folders = num_folders + $num_folders"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
