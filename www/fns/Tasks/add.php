<?php

namespace Tasks;

function add ($mysqli, $idusers, $tasktext, $tags) {
    $tasktext = mysqli_real_escape_string($mysqli, $tasktext);
    $tags = mysqli_real_escape_string($mysqli, $tags);
    $inserttime = $updatetime = time();
    mysqli_query(
        $mysqli,
        'insert into tasks'
        .' (idusers, tasktext, tags, inserttime, updatetime)'
        ." values ($idusers, '$tasktext', '$tags', $inserttime, $updatetime)"
    );
    return mysqli_insert_id($mysqli);
}
