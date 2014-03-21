<?php

namespace Bookmarks;

function add ($mysqli, $idusers, $title, $url, $tags) {
    $title = $mysqli->real_escape_string($title);
    $url = $mysqli->real_escape_string($url);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = $update_time = time();
    $sql = 'insert into bookmarks'
        .' (idusers, title, url, tags,'
        .' insert_time, update_time)'
        ." values ($idusers, '$title', '$url', '$tags',"
        ." $insert_time, $update_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
