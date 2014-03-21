<?php

namespace BookmarkTags;

function add ($mysqli, $idusers, $idbookmarks, array $tagnames, $title, $url) {
    $title = $mysqli->real_escape_string($title);
    $url = $mysqli->real_escape_string($url);
    $insert_time = $update_time = time();
    foreach ($tagnames as $tagname) {
        $tagname = $mysqli->real_escape_string($tagname);
        $sql = 'insert into bookmark_tags (idusers, idbookmarks, tagname,'
            .' title, url, insert_time, update_time)'
            ." values ($idusers, $idbookmarks, '$tagname',"
            ." '$title', '$url', $insert_time, $update_time)";
        $mysqli->query($sql);
    }
}
