<?php

namespace Users\Places\Received;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $latitude, $longitude, $altitude, $name, $tags) {

    include_once __DIR__.'/../../../ReceivedPlaces/add.php';
    \ReceivedPlaces\add($mysqli, $sender_id_users, $sender_username,
        $receiver_id_users, $latitude, $longitude, $altitude, $name, $tags);

    include_once __DIR__.'/addNumberNew.php';
    addNumberNew($mysqli, $receiver_id_users, 1);

}
