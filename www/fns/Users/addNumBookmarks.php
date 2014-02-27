<?php

namespace Users;

function addNumBookmarks ($mysqli, $idusers, $num_bookmarks) {
    $sql = "update users set num_bookmarks = num_bookmarks + $num_bookmarks"
        ." where idusers = $idusers";
    $mysqli->query($sql);
}
