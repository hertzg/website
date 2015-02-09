<?php

namespace Users\Places;

function addNumber ($mysqli, $id_users, $num_places) {
    $sql = "update users set num_places = num_places + $num_places"
        ." where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
