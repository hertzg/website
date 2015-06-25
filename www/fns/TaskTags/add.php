<?php

namespace TaskTags;

function add ($mysqli, $id_users, $id_tasks, $tag_names,
    $text, $title, $deadline_time, $tags, $top_priority) {

    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    if ($deadline_time === null) $deadline_time = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $num_tags = count($tag_names);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $top_priority = $top_priority ? '1' : '0';
    $insert_time = $update_time = time();

    $sql = 'insert into task_tags'
        .' (id_users, id_tasks, tag_name, text, title,'
        .' deadline_time, tags, num_tags, tags_json,'
        .' top_priority, insert_time, update_time) values';
    foreach ($tag_names as $i => $tag_name) {
        if ($i) $sql .= ', ';
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql .= "($id_users, $id_tasks, '$tag_name', '$text', '$title',"
            ." $deadline_time, '$tags', $num_tags, '$tags_json',"
            ." $top_priority, $insert_time, $update_time)";
    }
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
