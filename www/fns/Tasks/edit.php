<?php

namespace Tasks;

function edit ($mysqli, $id, $text,
    $deadline_time, $tags, $tag_names, $top_priority) {

    $text = $mysqli->real_escape_string($text);
    if ($deadline_time === null) $deadline_time = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $top_priority = $top_priority ? '1' : '0';
    $update_time = time();

    $sql = "update tasks set text = '$text', deadline_time = $deadline_time,"
        ." tags = '$tags', num_tags = $num_tags, tags_json = '$tags_json',"
        ." top_priority = $top_priority, update_time = $update_time,"
        ." revision = revision + 1 where id = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
