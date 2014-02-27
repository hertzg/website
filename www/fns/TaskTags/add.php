<?php

namespace TaskTags;

function add ($mysqli, $idusers, $idtasks, array $tagnames, $tasktext, $tags) {
    $tasktext = $mysqli->real_escape_string($tasktext);
    $tags = $mysqli->real_escape_string($tags);
    $inserttime = $updatetime = time();
    foreach ($tagnames as $tagname) {
        $tagname = $mysqli->real_escape_string($tagname);
        $sql = 'insert into tasktags (idusers, idtasks, tagname,'
            .' tasktext, tags, inserttime, updatetime)'
            ." values ($idusers, $idtasks, '$tagname',"
            ." '$tasktext', '$tags', $inserttime, $updatetime)";
        $mysqli->query($sql);
    }
}
