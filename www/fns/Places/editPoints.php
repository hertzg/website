<?php

namespace Places;

function editPoints ($mysqli, $id, $latitude,
    $longitude, $altitude, $num_points, $updateApiKey) {

    if ($altitude === null) $altitude = 'null';
    $update_time = time();
    if ($updateApiKey === null) {
        $update_api_key_id = $update_api_key_name = 'null';
    } else {

        $update_api_key_id = $updateApiKey->id;

        $name = $updateApiKey->name;
        $update_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = "update places set latitude = $latitude, longitude = $longitude,"
        ." altitude = $altitude, num_points = $num_points,"
        ." update_time = $update_time, update_api_key_id = $update_api_key_id,"
        ." update_api_key_name = $update_api_key_name,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
