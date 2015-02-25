<?php

namespace Users\Connections;

function get ($mysqli, $user, $id) {

    if (!$user->num_connections) return;

    include_once __DIR__.'/../../Connections/getOnUser.php';
    return \Connections\getOnUser($mysqli, $user->id_users, $id);

}
