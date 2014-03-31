<?php

namespace Users;

function showBookmarks ($mysqli, $id_users, $show) {
    $show_bookmarks = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_bookmarks = $show_bookmarks"
        ." where id_users = $id_users"
    );
}
