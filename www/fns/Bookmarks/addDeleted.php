<?php

namespace Bookmarks;

function addDeleted ($mysqli, $id, $id_users,
    $url, $title, $tags, $tag_names, $insert_time, $update_time) {

    $url = $mysqli->real_escape_string($url);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));

    $sql = 'insert into bookmarks'
        .' (id_bookmarks, id_users, url, title,'
        .' tags, tags_json, insert_time, update_time)'
        ." values ($id, $id_users, '$url', '$title',"
        ." '$tags', '$tags_json', $insert_time, $update_time)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
