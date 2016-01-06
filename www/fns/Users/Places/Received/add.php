<?php

namespace Users\Places\Received;

function add ($mysqli, $sender_id_users, $sender_username,
    $receiver_id_users, $latitude, $longitude, $altitude,
    $name, $description, $tags, $sender_address = null) {

    include_once __DIR__.'/../../../ReceivedPlaces/add.php';
    \ReceivedPlaces\add($mysqli, $sender_address,
        $sender_id_users, $sender_username, $receiver_id_users,
        $latitude, $longitude, $altitude, $name, $description, $tags);

    $sql = 'update users set num_received_places = num_received_places + 1,'
        .' home_num_new_received_places = home_num_new_received_places + 1'
        ." where id_users = $receiver_id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
