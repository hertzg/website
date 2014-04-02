<?php

namespace Bookmarks;

function add ($mysqli, $id_users, $url, $title, $tags) {
    $url = $mysqli->real_escape_string($url);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = $update_time = time();
    $sql = 'insert into bookmarks'
        .' (id_users, url, title, tags,'
        .' insert_time, update_time)'
        ." values ($id_users, '$url', '$title', '$tags',"
        ." $insert_time, $update_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
