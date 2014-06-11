<?php

namespace Users\Bookmarks;

function deleteAll ($mysqli, $id_users) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Bookmarks/indexOnUser.php";
    $bookmarks = \Bookmarks\indexOnUser($mysqli, $id_users);

    if ($bookmarks) {
        include_once "$fnsDir/DeletedItems/Bookmarks/add.php";
        foreach ($bookmarks as $bookmark) {
            \DeletedItems\Bookmarks\add($mysqli, $bookmark);
        }
    }

    include_once "$fnsDir/Bookmarks/deleteOnUser.php";
    \Bookmarks\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/BookmarkTags/deleteOnUser.php";
    \BookmarkTags\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_bookmarks = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
