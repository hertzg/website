<?php

namespace Connections;

function editConnectedUser ($mysqli,
    $connected_id_users, $username, $timezone) {

    $username = $mysqli->real_escape_string($username);
    $sql = "update connections set username = '$username',"
        ." timezone = $timezone where connected_id_users = $connected_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
