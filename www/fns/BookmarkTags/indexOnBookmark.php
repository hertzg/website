<?php

namespace BookmarkTags;

function indexOnBookmark ($mysqli, $idbookmarks) {
    $sql = 'select * from bookmarktags'
        ." where idbookmarks = $idbookmarks order by tagname";
    include_once __DIR__.'/../mysqli_query_object.php';
    return mysqli_query_object($mysqli, $sql);
}
