<?php

namespace PlaceTags;

function editPlace ($mysqli, $id_places, $latitude, $longitude,
    $name, $description, $tags, $tag_names, $insert_time, $update_time) {

    $name = $mysqli->real_escape_string($name);
    $description = $mysqli->real_escape_string($description);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));

    $sql = "update place_tags set latitude = $latitude,"
        ." longitude = $longitude, name = '$name',"
        ." description = '$description', tags = '$tags', num_tags = $num_tags,"
        ." tags_json = '$tags_json', insert_time = $insert_time,"
        ." update_time = $update_time where id_places = $id_places";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
