<?php

namespace Users\Places\Received;

function addNumber ($mysqli, $id_users, $n) {
    $sql = "update users set num_received_places = num_received_places + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
