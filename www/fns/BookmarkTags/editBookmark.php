<?php

namespace BookmarkTags;

function editBookmark ($mysqli, $id_bookmarks,
    $url, $title, $insert_time, $update_time) {

    $title = $mysqli->real_escape_string($title);
    $url = $mysqli->real_escape_string($url);

    $sql = "update bookmark_tags set title = '$title', url = '$url',"
        ." insert_time = $insert_time, update_time = $update_time"
        ." where id_bookmarks = $id_bookmarks";

    $mysqli->query($sql) || trigger_error($mysqli->error);

}
