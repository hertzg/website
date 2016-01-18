<?php

namespace Users\Bookmarks;

function delete ($mysqli, $bookmark, $apiKey = null) {

    $id = $bookmark->id;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Bookmarks/delete.php";
    \Bookmarks\delete($mysqli, $id);

    include_once "$fnsDir/BookmarkRevisions/setDeletedOnBookmark.php";
    \BookmarkRevisions\setDeletedOnBookmark($mysqli, $id, true);

    if ($bookmark->num_tags) {
        include_once "$fnsDir/BookmarkTags/deleteOnBookmark.php";
        \BookmarkTags\deleteOnBookmark($mysqli, $id);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $bookmark->id_users, -1);

    include_once __DIR__.'/../DeletedItems/addBookmark.php';
    \Users\DeletedItems\addBookmark($mysqli, $bookmark, $apiKey);

}
