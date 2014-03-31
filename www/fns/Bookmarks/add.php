<?php

namespace Bookmarks;

function add ($mysqli, $id_users, $title, $url, $tags) {
    $title = $mysqli->real_escape_string($title);
    $url = $mysqli->real_escape_string($url);
    $tags = $mysqli->real_escape_string($tags);
    $insert_time = $update_time = time();
    $sql = 'insert into bookmarks'
        .' (id_users, title, url, tags,'
        .' insert_time, update_time)'
        ." values ($id_users, '$title', '$url', '$tags',"
        ." $insert_time, $update_time)";
    $mysqli->query($sql);
    return $mysqli->insert_id;
}
