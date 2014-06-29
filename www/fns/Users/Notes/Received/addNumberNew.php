<?php

namespace Users\Notes\Received;

function addNumberNew ($mysqli, $id_users, $n) {
    $sql = "update users set num_received_notes = num_received_notes + $n,"
        ." home_num_new_received_notes = home_num_new_received_notes + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
