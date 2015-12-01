<?php

namespace Calculations;

function addDeleted ($mysqli, $id, $id_users, $expression, $title,
    $tags, $tag_names, $insert_time, $update_time, $revision) {

    $expression = $mysqli->real_escape_string($expression);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));

    $sql = 'insert into calculations'
        .' (id, id_users, expression, title, tags,'
        .' num_tags, tags_json, insert_time, update_time, revision)'
        ." values ($id, $id_users, '$expression', '$title', '$tags',"
        ." $num_tags, '$tags_json', $insert_time, $update_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
