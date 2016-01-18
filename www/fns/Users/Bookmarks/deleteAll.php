<?php

namespace Users\Bookmarks;

function deleteAll ($mysqli, $user, $apiKey = null) {

    if (!$user->num_bookmarks) return;

    $id_users = $user->id_users;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Bookmarks/indexOnUser.php";
    $bookmarks = \Bookmarks\indexOnUser($mysqli, $id_users);

    if ($bookmarks) {
        include_once __DIR__.'/../DeletedItems/addBookmark.php';
        foreach ($bookmarks as $bookmark) {
            \Users\DeletedItems\addBookmark($mysqli, $bookmark, $apiKey);
        }
    }

    include_once "$fnsDir/Bookmarks/deleteOnUser.php";
    \Bookmarks\deleteOnUser($mysqli, $id_users);

    include_once "$fnsDir/BookmarkRevisions/setDeletedOnUser.php";
    \BookmarkRevisions\setDeletedOnUser($mysqli, $id_users, true);

    include_once "$fnsDir/BookmarkTags/deleteOnUser.php";
    \BookmarkTags\deleteOnUser($mysqli, $id_users);

    $sql = "update users set num_bookmarks = 0 where id_users = $id_users";
    $mysqli->query($sql) || trigger_error($mysqli->error);

}
