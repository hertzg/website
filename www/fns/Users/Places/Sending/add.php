<?php

namespace Users\Places\Sending;

function add ($mysqli, $user, $recipient, $latitude,
    $longitude, $altitude, $name, $description, $tags) {

    include_once __DIR__.'/../../../SendingPlaces/add.php';
    \SendingPlaces\add($mysqli, $user->id_users,
        $user->username, $recipient['username'],
        $recipient['address'], $recipient['id_admin_connections'],
        $recipient['their_exchange_api_key'], $latitude,
        $longitude, $altitude, $name, $description, $tags);

}
