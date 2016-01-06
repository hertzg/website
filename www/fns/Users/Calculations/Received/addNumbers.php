<?php

namespace Users\Calculations\Received;

function addNumbers ($mysqli, $id_users, $num, $num_archived) {
    $sql = 'update users set'
        ." num_received_calculations = num_received_calculations + $num,"
        .' num_archived_received_calculations'
        ." = num_archived_received_calculations + $num_archived"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
