<?php

namespace Notes;

function add ($mysqli, $idusers, $notetext, $tags) {
    $notetext = $mysqli->real_escape_string($notetext);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = $update_time = time();
    $sql = 'insert into notes'
        .' (idusers, notetext, tags,'
        .' insert_time, update_time)'
        ." values ($idusers, '$notetext', '$tags',"
        ." $insert_time, $update_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
