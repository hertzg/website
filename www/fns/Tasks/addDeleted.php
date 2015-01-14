<?php

namespace Tasks;

function addDeleted ($mysqli, $id, $id_users, $text, $title, $deadline_time,
    $tags, $tag_names, $top_priority, $insert_time, $update_time, $revision) {

    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    if ($deadline_time === null) $deadline_time = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $top_priority = $top_priority ? '1' : '0';

    $sql = 'insert into tasks'
        .' (id, id_users, text, title, deadline_time,'
        .' tags, num_tags, tags_json, top_priority,'
        .' insert_time, update_time, revision)'
        ." values ($id, $id_users, '$text', '$title', $deadline_time,"
        ." '$tags', $num_tags, '$tags_json', $top_priority,"
        ." $insert_time, $update_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
