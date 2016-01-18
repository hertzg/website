<?php

namespace BookmarkRevisions;

function add ($mysqli, $id_bookmarks, $id_users,
    $url, $title, $tags, $insert_time, $revision) {

    $url = $mysqli->real_escape_string($url);
    $title = $mysqli->real_escape_string($title);
    $tags = $mysqli->real_escape_string($tags);

    $sql = 'insert into bookmark_revisions'
        .' (id_bookmarks, id_users, url,'
        .' title, tags, insert_time, revision)'
        ." values ($id_bookmarks, $id_users, '$url',"
        ." '$title', '$tags', $insert_time, $revision)";

    $mysqli->query($sql) || trigger_error($mysqli->error);

    return $mysqli->insert_id;

}
