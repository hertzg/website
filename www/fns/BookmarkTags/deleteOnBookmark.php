<?php

namespace BookmarkTags;

function deleteOnBookmark ($mysqli, $idbookmarks) {
    $sql = "delete from bookmarktags where idbookmarks = $idbookmarks";
    $mysqli->query($sql);
}
