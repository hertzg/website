<?php

namespace TaskTags;

function add ($mysqli, $idusers, $idtasks, array $tagnames, $tasktext, $tags) {
    $tasktext = $mysqli->real_escape_string($tasktext);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = $update_time = time();
    foreach ($tagnames as $tagname) {
        $tagname = $mysqli->real_escape_string($tagname);
        $sql = 'insert into tasktags (idusers, idtasks, tagname,'
            .' tasktext, tags, insert_time, update_time)'
            ." values ($idusers, $idtasks, '$tagname',"
            ." '$tasktext', '$tags', $insert_time, $update_time)";
        $mysqli->query($sql);
    }
}
