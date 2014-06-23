<?php

namespace ReceivedFiles;

function commit ($mysqli, $id) {
    $sql = "update received_files set committed = 1 where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
