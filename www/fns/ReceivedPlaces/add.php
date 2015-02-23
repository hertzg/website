<?php

namespace ReceivedPlaces;

function add ($mysqli, $sender_id_users,
    $sender_username, $receiver_id_users, $latitude,
    $longitude, $altitude, $name, $description, $tags) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    if ($altitude === null) $altitude = 'null';
    $name = $mysqli->real_escape_string($name);
    $description = $mysqli->real_escape_string($description);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = time();

    $sql = 'insert into received_places'
        .' (sender_id_users, sender_username,'
        .' receiver_id_users, latitude, longitude, altitude,'
        .' name, description, tags, insert_time)'
        ." values ($sender_id_users, '$sender_username',"
        ." $receiver_id_users, $latitude, $longitude, $altitude,"
        ." '$name', '$description', '$tags', $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
