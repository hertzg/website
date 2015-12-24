<?php

namespace SendingPlaces;

function add ($mysqli, $id_users, $sender_username, $receiver_username,
    $receiver_address, $id_admin_connections, $their_exchange_api_key,
    $latitude, $longitude, $altitude, $name, $description, $tags) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $receiver_username = $mysqli->real_escape_string($receiver_username);
    $receiver_address = $mysqli->real_escape_string($receiver_address);
    if ($altitude === null) $altitude = 'null';
    $name = $mysqli->real_escape_string($name);
    $description = $mysqli->real_escape_string($description);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = time();

    $sql = 'insert into sending_places'
        .' (id_users, sender_username, receiver_username,'
        .' receiver_address, id_admin_connections,'
        .' their_exchange_api_key, latitude, longitude,'
        .' altitude, name, description, tags, insert_time)'
        ." values ($id_users, '$sender_username', '$receiver_username',"
        ." '$receiver_address', $id_admin_connections,"
        ." '$their_exchange_api_key', $latitude, $longitude,"
        ." $altitude, '$name', '$description', '$tags', $insert_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
