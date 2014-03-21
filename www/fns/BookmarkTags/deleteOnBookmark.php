<?php

namespace BookmarkTags;

function deleteOnBookmark ($mysqli, $idbookmarks) {
    $sql = "delete from bookmark_tags where idbookmarks = $idbookmarks";
    $mysqli->query($sql);
}
