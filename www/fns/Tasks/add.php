<?php

namespace Tasks;

function add ($mysqli, $id_users, $text,
    $deadline_time, $tags, $tag_names, $top_priority) {

    $text = $mysqli->real_escape_string($text);
    if ($deadline_time === null) $deadline_time = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $top_priority = $top_priority ? '1' : '0';
    $insert_time = $update_time = time();

    $sql = 'insert into tasks'
        .' (id_users, text, deadline_time, tags,'
        .' tags_json, top_priority, insert_time, update_time)'
        ." values ($id_users, '$text', $deadline_time, '$tags',"
        ." '$tags_json', $top_priority, $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
