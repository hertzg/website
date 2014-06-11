<?php

namespace Users\Bookmarks;

function delete ($mysqli, $bookmark) {

    $id = $bookmark->id_bookmarks;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Bookmarks/delete.php";
    \Bookmarks\delete($mysqli, $id);

    include_once "$fnsDir/BookmarkTags/deleteOnBookmark.php";
    \BookmarkTags\deleteOnBookmark($mysqli, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $bookmark->id_users, -1);

    include_once "$fnsDir/DeletedItems/Bookmarks/add.php";
    \DeletedItems\Bookmarks\add($mysqli, $bookmark);

}
