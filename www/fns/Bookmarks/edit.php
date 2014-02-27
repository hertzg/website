<?php

namespace Bookmarks;

function edit ($mysqli, $idusers, $id, $title, $url, $tags) {
    $title = $mysqli->real_escape_string($title);
    $url = $mysqli->real_escape_string($url);
    $tags = $mysqli->real_escape_string($tags);
    $updatetime = time();
    $sql = 'update bookmarks set'
        ." title = '$title',"
        ." url = '$url',"
        ." tags = '$tags',"
        ." updatetime = $updatetime"
        ." where idusers = $idusers and idbookmarks = $id";
    $mysqli->query($sql);
}
