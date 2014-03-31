<?php

namespace Folders;

function move ($mysqli, $id_users, $id_folders, $parent_id_folders) {
    $sql = "update folders set parent_id_folders = $parent_id_folders"
        ." where id_users = $id_users and id_folders = $id_folders";
    $mysqli->query($sql);
}
