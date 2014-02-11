<?php

namespace Notes;

function add ($mysqli, $idusers, $notetext, $tags) {
    $notetext = mysqli_real_escape_string($mysqli, $notetext);
    $tags = mysqli_real_escape_string($mysqli, $tags);
    $inserttime = $updatetime = time();
    mysqli_query(
        $mysqli,
        'insert into notes'
        .' (idusers, notetext, tags,'
        .' inserttime, updatetime)'
        ." values ($idusers, '$notetext', '$tags',"
        ." $inserttime, $updatetime)"
    );
    return mysqli_insert_id($mysqli);
}
