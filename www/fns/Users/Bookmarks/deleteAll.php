<?php

namespace Users\Bookmarks;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../Bookmarks/deleteOnUser.php';
    \Bookmarks\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/../../BookmarkTags/deleteOnUser.php';
    \BookmarkTags\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_bookmarks = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
