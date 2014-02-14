<?php

namespace TaskTags;

function add ($mysqli, $idusers, $idtasks, array $tagnames, $tasktext, $tags) {
    $tasktext = mysqli_real_escape_string($mysqli, $tasktext);
    $tags = mysqli_real_escape_string($mysqli, $tags);
    $inserttime = $updatetime = time();
    foreach ($tagnames as $tagname) {
        $tagname = mysqli_real_escape_string($mysqli, $tagname);
        mysqli_query(
            $mysqli,
            'insert into tasktags (idusers, idtasks, tagname,'
            .' tasktext, tags, inserttime, updatetime)'
            ." values ($idusers, $idtasks, '$tagname',"
            ." '$tasktext', '$tags', $inserttime, $updatetime)"
        );
    }
}
