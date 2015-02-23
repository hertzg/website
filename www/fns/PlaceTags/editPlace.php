<?php

namespace PlaceTags;

function editPlace ($mysqli, $id_places, $latitude,
    $longitude, $name, $description, $tags, $insert_time, $update_time) {

    $name = $mysqli->real_escape_string($name);
    $description = $mysqli->real_escape_string($description);
    $tags = $mysqli->real_escape_string($tags);

    $sql = "update place_tags set latitude = $latitude,"
        ." longitude = $longitude, name = '$name',"
        ." description = '$description', tags = '$tags',"
        ." insert_time = $insert_time, update_time = $update_time"
        ." where id_places = $id_places";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
