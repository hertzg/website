<?php

namespace Tasks;

function add ($mysqli, $id_users, $text, $deadline_time,
    $tags, $tag_names, $top_priority, $insertApiKey) {

    $text = $mysqli->real_escape_string($text);
    if ($deadline_time === null) $deadline_time = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $top_priority = $top_priority ? '1' : '0';
    $insert_time = $update_time = time();
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into tasks'
        .' (id_users, text, deadline_time, tags, num_tags,'
        .' tags_json, top_priority, insert_time, update_time,'
        .' insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, '$text', $deadline_time, '$tags', $num_tags,"
        ." '$tags_json', $top_priority, $insert_time, $update_time,"
        ." $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
