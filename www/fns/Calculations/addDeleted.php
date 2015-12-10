<?php

namespace Calculations;

function addDeleted ($mysqli, $id, $id_users, $expression,
    $title, $tags, $tag_names, $value, $error, $error_char,
    $referenced_ids, $insert_time, $update_time, $revision) {

    $expression = $mysqli->real_escape_string($expression);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $num_referenced = count($referenced_ids);
    $referenced_json = $mysqli->real_escape_string(json_encode($referenced_ids));
    if ($value === null) {
        $value = 'null';
        $error = "'".$mysqli->real_escape_string($error)."'";
    } else {
        $error = $error_char = 'null';
    }

    $sql = 'insert into calculations'
        .' (id, id_users, expression, title, tags,'
        .' num_tags, tags_json, value, error, error_char,'
        .' num_referenced, referenced_json,'
        .' insert_time, update_time, revision)'
        ." values ($id, $id_users, '$expression', '$title', '$tags',"
        ." $num_tags, '$tags_json', $value, $error, $error_char,"
        ." $num_referenced, $referenced_json',"
        ." $insert_time, $update_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
