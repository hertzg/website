<?php

namespace ReceivedFolders;

function delete ($mysqli, $id) {
    $sql = "delete from received_folders where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
