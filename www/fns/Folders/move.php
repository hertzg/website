<?php

namespace Folders;

function move ($mysqli, $id_folders, $parent_id) {
    $sql = "update folders set parent_id = $parent_id"
        ." where id_folders = $id_folders";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
