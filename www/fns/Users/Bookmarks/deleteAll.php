<?php

namespace Users\Bookmarks;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../Bookmarks/indexOnUser.php';
    $bookmarks = \Bookmarks\indexOnUser($mysqli, $id_users);

    if ($bookmarks) {
        include_once __DIR__.'/../../DeletedItems/Bookmarks/add.php';
        foreach ($bookmarks as $bookmark) {
            \DeletedItems\Bookmarks\add($mysqli, $bookmark);
        }
    }

    include_once __DIR__.'/../../Bookmarks/deleteOnUser.php';
    \Bookmarks\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/../../BookmarkTags/deleteOnUser.php';
    \BookmarkTags\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_bookmarks = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
