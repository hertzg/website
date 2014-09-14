<?php

namespace Connections;

function getByConnectedUser ($mysqli, $id_users,
    $connected_id_users, $exclude_connected_id_users = 0) {

    $sql = "select * from connections where id_users = $id_users"
        ." and connected_id_users = $connected_id_users"
        ." and connected_id_users != $exclude_connected_id_users";
    include_once __DIR__.'/../mysqli_single_object.php';
    return mysqli_single_object($mysqli, $sql);

}
