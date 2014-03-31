<?php

namespace TaskTags;

function add ($mysqli, $id_users, $id_tasks, array $tag_names, $text, $tags) {
    $text = $mysqli->real_escape_string($text);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = $update_time = time();
    foreach ($tag_names as $tag_name) {
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql = 'insert into task_tags (id_users, id_tasks, tag_name,'
            .' text, tags, insert_time, update_time)'
            ." values ($id_users, $id_tasks, '$tag_name',"
            ." '$text', '$tags', $insert_time, $update_time)";
        $mysqli->query($sql);
    }
}
