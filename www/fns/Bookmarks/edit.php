<?php

namespace Bookmarks;

function edit ($mysqli, $idusers, $id, $title, $url, $tags) {
    $title = mysqli_real_escape_string($mysqli, $title);
    $url = mysqli_real_escape_string($mysqli, $url);
    $tags = mysqli_real_escape_string($mysqli, $tags);
    $updatetime = time();
    mysqli_query(
        $mysqli,
        'update bookmarks set'
        ." title = '$title',"
        ." url = '$url',"
        ." tags = '$tags',"
        ." updatetime = $updatetime"
        ." where idusers = $idusers and idbookmarks = $id"
    );
}
