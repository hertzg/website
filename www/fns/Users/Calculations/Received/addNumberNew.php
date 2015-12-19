<?php

namespace Users\Calculations\Received;

function addNumberNew ($mysqli, $id_users, $n) {
    $sql = 'update users set'
        ." num_received_calculations = num_received_calculations + $n,"
        .' home_num_new_received_calculations'
        ." = home_num_new_received_calculations + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
