<?php

namespace Calculations;

function edit ($mysqli, $id, $title, $expression,
    $tags, $tag_names, $update_time, $updateApiKey) {

    $title = $mysqli->real_escape_string($title);
    $expression = $mysqli->real_escape_string($expression);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
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
        ." update_time = $update_time, update_api_key_id = $update_api_key_id,"
        ." update_api_key_name = $update_api_key_name,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
