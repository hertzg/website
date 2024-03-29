<?php

namespace PlaceTags;

function add ($mysqli, $id_users, $id_places,
    $tag_names, $latitude, $longitude, $name,
    $description, $tags, $insert_time, $update_time) {

    $name = $mysqli->real_escape_string($name);
    $description = $mysqli->real_escape_string($description);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));

    $sql = 'insert into place_tags'
        .' (id_users, id_places, tag_name, latitude,'
        .' longitude, name, description, tags, num_tags,'
        .' tags_json, insert_time, update_time) values';
    foreach ($tag_names as $i => $tag_name) {
        if ($i) $sql .= ', ';
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql .= "($id_users, $id_places, '$tag_name', $latitude,"
            ." $longitude, '$name', '$description', '$tags', $num_tags,"
            ." '$tags_json', $insert_time, $update_time)";
    }
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
