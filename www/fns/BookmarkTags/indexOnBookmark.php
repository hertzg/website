<?php

namespace BookmarkTags;

function indexOnBookmark ($mysqli, $id_bookmarks) {
    $sql = 'select * from bookmark_tags'
        ." where id_bookmarks = $id_bookmarks order by tag_name";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
