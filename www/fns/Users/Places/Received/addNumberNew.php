<?php

namespace Users\Places\Received;

function addNumberNew ($mysqli, $id_users, $n) {
    $sql = "update users set num_received_places = num_received_places + $n,"
        ." home_num_new_received_places = home_num_new_received_places + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
