<?php

namespace Tasks;

function addDeleted ($mysqli, $id, $id_users, $text, $deadline_time,
    $tags, $tag_names, $top_priority, $insert_time, $update_time) {

    $text = $mysqli->real_escape_string($text);
    if ($deadline_time === null) $deadline_time = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $top_priority = $top_priority ? '1' : '0';

    $sql = 'insert into tasks'
        .' (id_tasks, id_users, text, deadline_time, tags,'
        .' tags_json, top_priority, insert_time, update_time)'
        ." values ($id, $id_users, '$text', $deadline_time, '$tags',"
        ." '$tags_json', $top_priority, $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
