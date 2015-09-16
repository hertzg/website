<?php

namespace BarCharts;

function edit ($mysqli, $id, $name, $tags,
    $tag_names, $update_time, $updateApiKey) {

    $name = $mysqli->real_escape_string($name);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    if ($updateApiKey === null) {
        $update_api_key_id = $update_api_key_name = 'null';
    } else {

        $update_api_key_id = $updateApiKey->id;

        $escaped_name = $mysqli->real_escape_string($updateApiKey->name);
        $update_api_key_name = "'$escaped_name'";

    }

    $sql = "update bar_charts set name = '$name', tags = '$tags',"
        ." num_tags = $num_tags, tags_json = '$tags_json',"
        ." update_time = $update_time, update_api_key_id = $update_api_key_id,"
        ." update_api_key_name = $update_api_key_name,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
