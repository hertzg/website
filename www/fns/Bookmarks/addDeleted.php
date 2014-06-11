<?php

namespace Bookmarks;

function addDeleted ($mysqli, $id, $id_users,
    $url, $title, $tags, $insert_time, $update_time) {

    $url = $mysqli->real_escape_string($url);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);

    $sql = 'insert into bookmarks'
        .' (id_bookmarks, id_users, url, title, tags,'
        .' insert_time, update_time)'
        ." values ($id, $id_users, '$url', '$title', '$tags',"
        ." $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
