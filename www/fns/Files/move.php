<?php

namespace Files;

function move ($mysqli, $id_users, $id, $id_folders) {
    $sql = "update files set id_folders = $id_folders"
        ." where id_users = $id_users and id_files = $id";
    $mysqli->query($sql);
}
