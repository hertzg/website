<?php

namespace TaskTags;

function add ($mysqli, $id_users, $id_tasks, array $tag_names, $task_text, $tags) {
    $task_text = $mysqli->real_escape_string($task_text);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = $update_time = time();
    foreach ($tag_names as $tag_name) {
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql = 'insert into task_tags (id_users, id_tasks, tag_name,'
            .' task_text, tags, insert_time, update_time)'
            ." values ($id_users, $id_tasks, '$tag_name',"
            ." '$task_text', '$tags', $insert_time, $update_time)";
        $mysqli->query($sql);
    }
}
