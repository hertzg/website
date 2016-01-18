<?php

namespace BookmarkRevisions;

function setDeletedOnBookmark ($mysqli, $id_bookmarks, $deleted) {
    $deleted = $deleted ? '1' : '0';
    $sql = "update bookmark_revisions set deleted = $deleted"
        ." where id_bookmarks = $id_bookmarks";
    $mysqli->query($sql) || trigger_error($mysqli->error);
}
