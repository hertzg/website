<?php

namespace Users\Bookmarks;

function delete ($mysqli, $bookmark) {

    $id = $bookmark->id_bookmarks;

    include_once __DIR__.'/../../Bookmarks/delete.php';
    \Bookmarks\delete($mysqli, $id);

    include_once __DIR__.'/../../BookmarkTags/deleteOnBookmark.php';
    \BookmarkTags\deleteOnBookmark($mysqli, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $bookmark->id_users, -1);

}
