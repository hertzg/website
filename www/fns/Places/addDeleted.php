<?php

namespace Places;

function addDeleted ($mysqli, $id, $id_users, $latitude, $longitude,
    $name, $tags, $tag_names, $insert_time, $update_time, $revision) {

    $name = $mysqli->real_escape_string($name);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));

    $sql = 'insert into places'
        .' (id, id_users, latitude, longitude, name, tags,'
        .' num_tags, tags_json, insert_time, update_time, revision)'
        ." values ($id, $id_users, $latitude, $longitude, '$name', '$tags',"
        ." $num_tags, '$tags_json', $insert_time, $update_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
