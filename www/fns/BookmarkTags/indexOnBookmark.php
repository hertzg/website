<?php

namespace BookmarkTags;

function indexOnBookmark ($mysqli, $idbookmarks) {
    $sql = 'select * from bookmark_tags'
        ." where idbookmarks = $idbookmarks order by tagname";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
