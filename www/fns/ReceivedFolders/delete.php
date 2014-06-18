<?php

namespace ReceivedFolders;

function delete ($mysqli, $receiver_id_users, $id) {
    $sql = "delete from received_folders where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
