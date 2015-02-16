<?php

namespace Places;

function edit ($mysqli, $id, $latitude, $longitude,
    $altitude, $name, $tags, $tag_names, $updateApiKey) {

    if ($altitude === null) $altitude = 'null';
    $name = $mysqli->real_escape_string($name);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $update_time = time();
    if ($updateApiKey === null) {
        $update_api_key_id = $update_api_key_name = 'null';
    } else {

        $update_api_key_id = $updateApiKey->id;

        $name = $updateApiKey->name;
        $update_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = "update places set latitude = $latitude, longitude = $longitude,"
        ." altitude = $altitude, name = '$name', tags = '$tags',"
        ." num_tags = $num_tags, tags_json = '$tags_json',"
        ." update_time = $update_time, update_api_key_id = $update_api_key_id,"
        ." update_api_key_name = $update_api_key_name,"
        ." num_points = 0, revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
