<?php

namespace Tasks;

function edit ($mysqli, $idusers, $id, $tasktext, $tags) {
    $tasktext = mysqli_real_escape_string($mysqli, $tasktext);
    $tags = mysqli_real_escape_string($mysqli, $tags);
    $updatetime = time();
    mysqli_query(
        $mysqli,
        'update tasks set'
        ." tasktext = '$tasktext',"
        ." tags = '$tags',"
        ." updatetime = $updatetime"
        ." where idusers = $idusers and idtasks = $id"
    );
}
