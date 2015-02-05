<?php

namespace TaskTags;

function editTask ($mysqli, $id_tasks, $text,
    $tags, $top_priority, $insert_time, $update_time) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);

    $sql = "update task_tags set text = '$text', tags = '$tags',"
        ." top_priority = $top_priority, insert_time = $insert_time,"
        ." update_time = $update_time where id_tasks = $id_tasks";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
