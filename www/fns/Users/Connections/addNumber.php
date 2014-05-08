<?php

namespace Users\Connections;

function addNumber ($mysqli, $id_users, $num_connections) {
    $sql = 'update users set'
        ." num_connections = num_connections + $num_connections"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
