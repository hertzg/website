<?php

namespace Users;

function showBookmarks ($mysqli, $idusers, $show) {
    $show_bookmarks = $show ? '1' : '0';
    $mysqli->query(
        "update users set show_bookmarks = $show_bookmarks"
        ." where idusers = $idusers"
    );
}
