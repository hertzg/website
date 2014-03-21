<?php

namespace Tasks;

function add ($mysqli, $idusers, $tasktext, $tags) {
    $tasktext = $mysqli->real_escape_string($tasktext);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = $update_time = time();
    $sql = 'insert into tasks'
        .' (idusers, tasktext, tags, insert_time, update_time)'
        ." values ($idusers, '$tasktext', '$tags', $insert_time, $update_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
