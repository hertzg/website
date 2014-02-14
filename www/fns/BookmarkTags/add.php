<?php

namespace BookmarkTags;

function add ($mysqli, $idusers, $idbookmarks, array $tagnames, $title, $url) {
    $title = mysqli_real_escape_string($mysqli, $title);
    $url = mysqli_real_escape_string($mysqli, $url);
    $inserttime = $updatetime = time();
    foreach ($tagnames as $tagname) {
        $tagname = mysqli_real_escape_string($mysqli, $tagname);
        mysqli_query(
            $mysqli,
            'insert into bookmarktags (idusers, idbookmarks, tagname,'
            .' title, url, inserttime, updatetime)'
            ." values ($idusers, $idbookmarks, '$tagname',"
            ." '$title', '$url', $inserttime, $updatetime)"
        );
    }
}
