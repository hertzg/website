<?php

namespace Users\Places;

function send ($mysqli, $user, $receiver_id_users, $place) {
    include_once __DIR__.'/Received/add.php';
    \Users\Places\Received\add($mysqli, $user->id_users,
        $user->username, $receiver_id_users, $place->latitude,
        $place->longitude, $place->altitude, $place->name, $place->tags);
}
