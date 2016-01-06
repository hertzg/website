<?php

namespace Users\Places\Received;

function addNumbers ($mysqli, $id_users, $num, $num_archived) {
    $sql = 'update users set'
        ." num_received_places = num_received_places + $num,"
        .' num_archived_received_places'
        ." = num_archived_received_places + $num_archived"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
