<?php

namespace Users;

function clearNumBookmarks ($mysqli, $idusers) {
    $sql = "update users set num_bookmarks = 0 where idusers = $idusers";
    $mysqli->query($sql);
}
