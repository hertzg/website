<?php

namespace BookmarkTags;

function add ($mysqli, $id_users, $id_bookmarks, array $tag_names, $title, $url) {
    $title = $mysqli->real_escape_string($title);
    $url = $mysqli->real_escape_string($url);
    $insert_time = $update_time = time();
    foreach ($tag_names as $tag_name) {
        $tag_name = $mysqli->real_escape_string($tag_name);
        $sql = 'insert into bookmark_tags (id_users, id_bookmarks, tag_name,'
            .' title, url, insert_time, update_time)'
            ." values ($id_users, $id_bookmarks, '$tag_name',"
            ." '$title', '$url', $insert_time, $update_time)";
        $mysqli->query($sql);
    }
}
