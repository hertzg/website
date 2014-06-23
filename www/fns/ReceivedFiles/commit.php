<?php

namespace ReceivedFiles;

function commit ($mysqli, $id) {
    $insert_time = time();
    $sql = 'update received_files set committed = 1,'
        ." insert_time = $insert_time where id = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
