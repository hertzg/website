<?php

namespace Tasks;

function add ($mysqli, $idusers, $tasktext, $tags) {
    $tasktext = $mysqli->real_escape_string($tasktext);
    $tags = $mysqli->real_escape_string($tags);
    $inserttime = $updatetime = time();
    $sql = 'insert into tasks'
        .' (idusers, tasktext, tags, inserttime, updatetime)'
        ." values ($idusers, '$tasktext', '$tags', $inserttime, $updatetime)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
