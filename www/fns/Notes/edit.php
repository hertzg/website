<?php

namespace Notes;

function edit ($mysqli, $idusers, $id, $notetext, $tags) {
    $notetext = $mysqli->real_escape_string($notetext);
    $tags = $mysqli->real_escape_string($tags);
    $updatetime = time();
    $sql = 'update notes set'
        ." notetext = '$notetext',"
        ." tags = '$tags',"
        ." updatetime = $updatetime"
        ." where idusers = $idusers and idnotes = $id"
    $mysqli->query($sql);
}
