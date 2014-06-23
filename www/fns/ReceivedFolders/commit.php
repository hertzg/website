<?php

namespace ReceivedFolders;

function commit ($mysqli, $id) {
    $sql = "update received_folders set committed = 1 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
