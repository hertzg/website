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

    $mysqli->query($sql) || trigger_error($mysqli->error);

    $id_bookmarks = $mysqli->insert_id;

    include_once __DIR__.'/../Users/Bookmarks/addNumber.php';
    \Users\Bookmarks\addNumber($mysqli, $id_users, 1);

    return $id_bookmarks;

}
