<?php

namespace PlacePoints;

function add ($mysqli, $id_users,
    $id_places, $latitude, $longitude, $altitude) {

    if ($altitude === null) $altitude = 'null';
    $insert_time = $update_time = time();

    $sql = 'insert into place_points (id_users, id_places, latitude,'
    .' longitude, altitude, insert_time, update_time)'
        ." values ($id_users, $id_places, $latitude,"
        ." $longitude, $altitude, $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
