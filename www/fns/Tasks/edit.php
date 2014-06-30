<?php

namespace Tasks;

function edit ($mysqli, $id_users, $id,
    $text, $deadline_time, $tags, $top_priority) {

    $text = $mysqli->real_escape_string($text);
    if ($deadline_time === null) $deadline_time = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $top_priority = $top_priority ? '1' : '0';
    $update_time = time();

    $sql = "update tasks set text = '$text', deadline_time = $deadline_time,"
        ." tags = '$tags', top_priority = $top_priority,"
        ." update_time = $update_time, num_edits = num_edits + 1"
        ." where id_users = $id_users and id_tasks = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
