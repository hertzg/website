<?php

namespace TaskRevisions;

function add ($mysqli, $id_tasks, $id_users, $text, $title,
    $deadline_time, $tags, $top_priority, $insert_time, $revision) {

    $text = $mysqli->real_escape_string($text);
    $title = $mysqli->real_escape_string($title);
    if ($deadline_time === null) $deadline_time = 'null';
    $tags = $mysqli->real_escape_string($tags);
    $top_priority = $top_priority ? '1' : '0';

    $sql = 'insert into task_revisions'
        .' (id_tasks, id_users, text, title, deadline_time,'
        .' tags, top_priority, insert_time, revision)'
        ." values ($id_tasks, $id_users, '$text', '$title', $deadline_time,"
        ." '$tags', $top_priority, $insert_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
