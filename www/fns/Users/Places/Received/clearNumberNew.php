<?php

namespace Users\Places\Received;

function clearNumberNew ($mysqli, $user) {
    $user->home_num_new_received_places = 0;
    $sql = 'update users set home_num_new_received_places = 0'
        ." where id_users = $user->id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
