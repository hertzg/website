<?php

namespace Bookmarks;

function edit ($mysqli, $id_users, $id, $title, $url, $tags) {
    $title = $mysqli->real_escape_string($title);
    $url = $mysqli->real_escape_string($url);
    $tags = $mysqli->real_escape_string($tags);
    $update_time = time();
    $sql = "update bookmarks set title = '$title',"
        ." url = '$url', tags = '$tags', update_time = $update_time"
        ." where id_users = $id_users and id_bookmarks = $id";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
