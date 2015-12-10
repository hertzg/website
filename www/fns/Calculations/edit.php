<?php

namespace Calculations;

function edit ($mysqli, $id, $title, $expression, $tags, $tag_names, $value,
    $error, $error_char, $num_referenced, $update_time, $updateApiKey) {

    $title = $mysqli->real_escape_string($title);
    $expression = $mysqli->real_escape_string($expression);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    if ($value === null) {
        $value = 'null';
        $error = "'".$mysqli->real_escape_string($error)."'";
    } else {
        $error = $error_char = 'null';
    }
    else $error = "'".$mysqli->real_escape_string($error)."'";
    if ($updateApiKey) {

        $update_api_key_id = $updateApiKey->id;

        $name = $updateApiKey->name;
        $update_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    } else {
        $update_api_key_id = $update_api_key_name = 'null';
    }

    $sql = "update calculations set title = '$title',"
        ." expression = '$expression', tags = '$tags',"
        ." num_tags = $num_tags, tags_json = '$tags_json',"
        ." value = $value, error = $error, error_char = $error_char,"
        ." num_referenced = $num_referenced, update_time = $update_time,"
        ." update_api_key_id = $update_api_key_id,"
        ." update_api_key_name = $update_api_key_name,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
