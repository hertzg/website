<?php

namespace Tasks;

function edit ($mysqli, $idusers, $id, $tasktext, $tags) {
    $tasktext = $mysqli->real_escape_string($tasktext);
    $tags = $mysqli->real_escape_string($tags);
    $update_time = time();
    $sql = 'update tasks set'
        ." tasktext = '$tasktext',"
        ." tags = '$tags',"
        ." update_time = $update_time"
        ." where idusers = $idusers and idtasks = $id";
    $mysqli->query($sql);
}
