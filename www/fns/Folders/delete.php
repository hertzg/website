<?php

namespace Folders;

function delete ($mysqli, $id) {
    $sql = "delete from folders where id_folders = $id";
    $mysqli->query($sql) || trigger_error($mysqli);
}
