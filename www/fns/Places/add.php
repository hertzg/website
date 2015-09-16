<?php

namespace Places;

function add ($mysqli, $id_users, $latitude,
    $longitude, $altitude, $name, $description, $tags,
    $tag_names, $insert_time, $update_time, $insertApiKey) {

    if ($altitude === null) $altitude = 'null';
    $name = $mysqli->real_escape_string($name);
    $description = $mysqli->real_escape_string($description);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $escaped_name = $mysqli->real_escape_string($insertApiKey->name);
        $insert_api_key_name = "'$escaped_name'";

    }

    $sql = 'insert into places'
        .' (id_users, latitude, longitude, altitude, name,'
        .' description, tags, num_tags, tags_json, num_points, insert_time,'
        .' update_time, insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, $latitude, $longitude, $altitude, '$name',"
        ." '$description', '$tags', $num_tags, '$tags_json', 1, $insert_time,"
        ." $update_time, $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
