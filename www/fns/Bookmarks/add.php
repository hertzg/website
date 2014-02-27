<?php

namespace Bookmarks;

function add ($mysqli, $idusers, $title, $url, $tags) {
    $title = $mysqli->real_escape_string($title);
    $url = $mysqli->real_escape_string($url);
    $tags = $mysqli->real_escape_string($tags);
    $inserttime = $updatetime = time();
    $sql = 'insert into bookmarks'
        .' (idusers, title, url, tags,'
        .' inserttime, updatetime)'
        ." values ($idusers, '$title', '$url', '$tags',"
        ." $inserttime, $updatetime)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
