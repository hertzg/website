<?php

namespace Bookmarks;

function add ($mysqli, $idusers, $title, $url, $tags) {
    $title = mysqli_real_escape_string($mysqli, $title);
    $url = mysqli_real_escape_string($mysqli, $url);
    $tags = mysqli_real_escape_string($mysqli, $tags);
    $inserttime = $updatetime = time();
    mysqli_query(
        $mysqli,
        'insert into bookmarks'
        .' (idusers, title, url, tags,'
        .' inserttime, updatetime)'
        ." values ($idusers, '$title', '$url', '$tags',"
        ." $inserttime, $updatetime)"
    );
    return mysqli_insert_id($mysqli);
}
