<?php

namespace Places;

function edit ($mysqli, $id, $latitude, $longitude, $altitude,
    $name, $description, $tags, $tag_names, $num_points, $updateApiKey) {

    if ($altitude === null) $altitude = 'null';
    $name = $mysqli->real_escape_string($name);
    $description = $mysqli->real_escape_string($description);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $update_time = time();
    if ($updateApiKey === null) {
        $update_api_key_id = $update_api_key_name = 'null';
    } else {

        $update_api_key_id = $updateApiKey->id;

        $escaped_name = $mysqli->real_escape_string($updateApiKey->name);
        $update_api_key_name = "'$escaped_name'";

    }

    $sql = "update places set latitude = $latitude,"
        ." longitude = $longitude, altitude = $altitude,"
        ." name = '$name', description = '$description', tags = '$tags',"
        ." num_tags = $num_tags, tags_json = '$tags_json',"
        ." update_time = $update_time, num_points = $num_points,"
        ." update_api_key_id = $update_api_key_id,"
        ." update_api_key_name = $update_api_key_name,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
