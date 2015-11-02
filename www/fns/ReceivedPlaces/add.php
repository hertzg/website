<?php

namespace ReceivedPlaces;

function add ($mysqli, $sender_address, $sender_id_users,
    $sender_username, $receiver_id_users, $latitude,
    $longitude, $altitude, $name, $description, $tags) {

    if ($sender_address === null) $sender_address = 'null';
    else $sender_address = "'".$mysqli->real_escape_string($sender_address)."'";
    if ($sender_id_users === null) $sender_id_users = 'null';
    $sender_username = $mysqli->real_escape_string($sender_username);
    if ($altitude === null) $altitude = 'null';
    $name = $mysqli->real_escape_string($name);
    $description = $mysqli->real_escape_string($description);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = time();

    $sql = 'insert into received_places'
        .' (sender_address, sender_id_users, sender_username,'
        .' receiver_id_users, latitude, longitude, altitude,'
        .' name, description, tags, insert_time)'
        ." values ($sender_address, $sender_id_users, '$sender_username',"
        ." $receiver_id_users, $latitude, $longitude, $altitude,"
        ." '$name', '$description', '$tags', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
