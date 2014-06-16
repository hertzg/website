<?php

namespace Files;

function delete ($mysqli, $id_users, $id) {

    $sql = "delete from files where id_users = $id_users and id_files = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    include_once __DIR__.'/File/delete.php';
    \Files\File\delete($id_users, $id);

}
