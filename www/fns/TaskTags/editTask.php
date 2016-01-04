<?php

namespace TaskTags;

function editTask ($mysqli, $id_tasks, $text, $title, $deadline_time,
    $tags, $tag_names, $top_priority, $insert_time, $update_time) {

    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    if ($deadline_time === null) $deadline_time = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));

    $sql = "update task_tags set text = '$text', title = '$title',"
        ." deadline_time = $deadline_time, tags = '$tags',"
        ." num_tags = $num_tags, tags_json = '$tags_json',"
        ." top_priority = $top_priority, insert_time = $insert_time,"
        ." update_time = $update_time where id_tasks = $id_tasks";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
