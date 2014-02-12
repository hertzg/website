<?php

namespace Notes;

function edit ($mysqli, $idusers, $id, $notetext, $tags) {
    $notetext = mysqli_real_escape_string($mysqli, $notetext);
    $tags = mysqli_real_escape_string($mysqli, $tags);
    $updatetime = time();
    mysqli_query(
        $mysqli,
        'update notes set'
        ." notetext = '$notetext',"
        ." tags = '$tags',"
        ." updatetime = $updatetime"
        ." where idusers = $idusers and idnotes = $id"
    );
}
