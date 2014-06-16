<?php

namespace ReceivedFiles;

function delete ($mysqli, $receiver_id_users, $id) {

    $sql = "delete from received_files where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    include_once __DIR__.'/File/delete.php';
    \ReceivedFiles\File\delete($receiver_id_users, $id);

}
