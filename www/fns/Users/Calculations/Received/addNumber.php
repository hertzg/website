<?php

namespace Users\Calculations\Received;

function addNumber ($mysqli, $id_users, $n) {
    $sql = 'update users set'
        ." num_received_calculations = num_received_calculations + $n"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
