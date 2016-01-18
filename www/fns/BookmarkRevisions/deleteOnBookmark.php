<?php

namespace BookmarkRevisions;

function deleteOnBookmark ($mysqli, $id_bookmarks) {
    $sql = "delete from bookmark_revisions where id_bookmarks = $id_bookmarks";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
