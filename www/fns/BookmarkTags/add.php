<?php

namespace BookmarkTags;

function add ($mysqli, $idusers, $idbookmarks, array $tagnames, $title, $url) {
    $title = $mysqli->real_escape_string($title);
    $url = $mysqli->real_escape_string($url);
    $inserttime = $updatetime = time();
    foreach ($tagnames as $tagname) {
        $tagname = $mysqli->real_escape_string($tagname);
        $sql = 'insert into bookmarktags (idusers, idbookmarks, tagname,'
            .' title, url, inserttime, updatetime)'
            ." values ($idusers, $idbookmarks, '$tagname',"
            ." '$title', '$url', $inserttime, $updatetime)";
        $mysqli->query($sql);
    }
}
