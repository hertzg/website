<?php

namespace Notes;

function add ($mysqli, $idusers, $notetext, $tags) {
    $notetext = $mysqli->real_escape_string($notetext);
    $tags = $mysqli->real_escape_string($tags);
    $inserttime = $updatetime = time();
    $sql = 'insert into notes'
        .' (idusers, notetext, tags,'
        .' inserttime, updatetime)'
        ." values ($idusers, '$notetext', '$tags',"
        ." $inserttime, $updatetime)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
