<?php

namespace BookmarkTags;

function deleteOnBookmark ($mysqli, $id_bookmarks) {
    $sql = "delete from bookmark_tags where id_bookmarks = $id_bookmarks";
    $mysqli->query($sql);
}
