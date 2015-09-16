<?php

namespace BookmarkTags;

function add ($mysqli, $id_users, $id_bookmarks,
    $tag_names, $url, $title, $insert_time, $update_time) {

    $url = $mysqli->real_escape_string($url);
    $title = $mysqli->real_escape_string($title);

    $sql = 'insert into bookmark_tags (id_users, id_bookmarks, tag_name,'
        .' url, title, insert_time, update_time) values ';
    foreach ($tag_names as $i => $tag_name) {
        if ($i) $sql .= ', ';
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql .= "($id_users, $id_bookmarks, '$tag_name',"
            ." '$url', '$title', $insert_time, $update_time)";
    }
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
