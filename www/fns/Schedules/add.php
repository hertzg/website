<?php

namespace Schedules;

function add ($mysqli, $id_users, $text, $interval, $offset,
    $tags, $tag_names, $insert_time, $update_time, $insertApiKey) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    if ($insertApiKey === null) {
        $insert_api_key_id = $insert_api_key_name = 'null';
    } else {

        $insert_api_key_id = $insertApiKey->id;

        $name = $insertApiKey->name;
        $insert_api_key_name = "'".$mysqli->real_escape_string($name)."'";

    }

    $sql = 'insert into schedules (id_users, text, `interval`, offset,'
        .' tags, num_tags, tags_json, insert_time, update_time,'
        .' insert_api_key_id, insert_api_key_name)'
        ." values ($id_users, '$text', $interval, $offset,"
        ." '$tags', $num_tags, '$tags_json', $insert_time, $update_time,"
        ." $insert_api_key_id, $insert_api_key_name)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
