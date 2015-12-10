<?php

namespace Calculations;

function add ($mysqli, $id_users, $expression,
    $title, $tags, $tag_names, $value, $error, $error_char,
    $referenced_ids, $insert_time, $update_time, $insertApiKey) {

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
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into calculations'
        .' (id_users, expression, title, tags,'
        .' num_tags, tags_json, value, error, error_char,'
        .' num_referenced, referenced_json, insert_time,'
        .' update_time, insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, '$expression', '$title', '$tags',"
        ." $num_tags, '$tags_json', $value, $error, $error_char,"
        ." $num_referenced, '$referenced_json', $insert_time,"
        ." $update_time, $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
