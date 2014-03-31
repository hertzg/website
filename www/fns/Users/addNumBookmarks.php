<?php

namespace Users;

function addNumBookmarks ($mysqli, $id_users, $num_bookmarks) {
    $sql = "update users set num_bookmarks = num_bookmarks + $num_bookmarks"
        ." where id_users = $id_users";
    $mysqli->query($sql);
}
