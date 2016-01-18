<?php

namespace BookmarkRevisions;

function indexOnBookmark ($mysqli, $id_bookmarks) {
    $sql = 'select * from bookmark_revisions'
        ." where id_bookmarks = $id_bookmarks order by insert_time desc";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
