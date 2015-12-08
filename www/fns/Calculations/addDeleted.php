<?php

namespace Calculations;

function addDeleted ($mysqli, $id, $id_users,
    $expression, $title, $tags, $tag_names, $value, $error,
    $error_char, $insert_time, $update_time, $revision) {

    $expression = $mysqli->real_escape_string($expression);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    if ($value === null) $value = 'null';
    if ($error === null) $error = 'null';
    else $error = "'".$mysqli->real_escape_string($error)."'";
    if ($error_char === null) $error_char = 'null';

    $sql = 'insert into calculations'
        .' (id, id_users, expression, title,'
        .' tags, num_tags, tags_json, value, error,'
        .' error_char, insert_time, update_time, revision)'
        ." values ($id, $id_users, '$expression', '$title',"
        ." '$tags', $num_tags, '$tags_json', $value, $error,"
        ." $error_char, $insert_time, $update_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
