<?php

namespace Users\Bookmarks;

function delete ($mysqli, $bookmark) {

    $id = $bookmark->id_bookmarks;
    $id_users = $bookmark->id_users;

    include_once __DIR__.'/../../Bookmarks/delete.php';
    \Bookmarks\delete($mysqli, $id);

    include_once __DIR__.'/../../BookmarkTags/deleteOnBookmark.php';
    \BookmarkTags\deleteOnBookmark($mysqli, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

    include_once __DIR__.'/../../DeletedItems/Bookmarks/add.php';
    \DeletedItems\Bookmarks\add($mysqli, $bookmark);

}
