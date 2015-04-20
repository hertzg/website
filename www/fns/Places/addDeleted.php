<?php

namespace Places;

function addDeleted ($mysqli, $id, $id_users, $latitude,
    $longitude, $altitude, $name, $description, $tags, $tag_names,
    $num_points, $insert_time, $update_time, $revision) {

    if ($altitude === null) $altitude = 'null';
    $name = $mysqli->real_escape_string($name);
    $description = $mysqli->real_escape_string($description);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));

    $sql = 'insert into places'
        .' (id, id_users, latitude, longitude, altitude,'
        .' name, description, tags, num_tags, tags_json,'
        .' num_points, insert_time, update_time, revision)'
        ." values ($id, $id_users, $latitude, $longitude, $altitude,"
        ." '$name', '$description', '$tags', $num_tags, '$tags_json',"
        ." $num_points, $insert_time, $update_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
