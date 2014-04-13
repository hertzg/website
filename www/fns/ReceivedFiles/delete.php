<?php

namespace ReceivedFiles;

function delete ($mysqli, $receiver_id_users, $id) {

    $sql = "delete from received_files where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);

    include_once __DIR__.'/filePath.php';
    $filePath = filePath($receiver_id_users, $id);

    if (is_file($filePath)) unlink($filePath);

}
