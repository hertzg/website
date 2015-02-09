<?php

namespace ReceivedPlaces;

function addDeleted ($mysqli, $id, $sender_id_users,
    $sender_username, $receiver_id_users, $latitude, $longitude,
    $name, $tags, $archived, $insert_time) {

    $sender_username = $mysqli->real_escape_string($sender_username);
    $name = $mysqli->real_escape_string($name);
    $tags = $mysqli->real_escape_string($tags);
    $archived = $archived ? '1' : '0';

    $sql = 'insert into received_places'
        .' (id, sender_id_users, sender_username,'
        .' receiver_id_users, latitude, longitude,'
        .' name, tags, archived, insert_time)'
        ." values ($id, $sender_id_users, '$sender_username'"
        .", $receiver_id_users, $latitude, $longitude,"
        ." '$name', '$tags', $archived, $insert_time)";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
