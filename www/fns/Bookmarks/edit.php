<?php

namespace Bookmarks;

function edit ($mysqli, $id_users, $id, $title, $url, $tags, $tag_names) {

    $title = $mysqli->real_escape_string($title);
    $url = $mysqli->real_escape_string($url);
    $tags = $mysqli->real_escape_string($tags);
    $tags_json = $mysqli->real_escape_string(json_encode($tag_names));
    $update_time = time();

    $sql = "update bookmarks set title = '$title', url = '$url',"
        ." tags = '$tags', tags_json = '$tags_json',"
        ." update_time = $update_time, revision = revision + 1"
        ." where id_users = $id_users and id_bookmarks = $id";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
