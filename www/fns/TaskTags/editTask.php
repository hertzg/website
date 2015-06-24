<?php

namespace TaskTags;

function editTask ($mysqli, $id_tasks, $text, $tags,
    $tag_names, $top_priority, $insert_time, $update_time) {

    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));

    $sql = "update task_tags set text = '$text', tags = '$tags',"
        ." tags_json = '$tags_json', top_priority = $top_priority,"
        ." insert_time = $insert_time, update_time = $update_time"
        ." where id_tasks = $id_tasks";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
