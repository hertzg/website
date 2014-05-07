<?php

namespace Users\Bookmarks;

function delete ($mysqli, $id, $id_users) {

    include_once __DIR__.'/../../Bookmarks/delete.php';
    \Bookmarks\delete($mysqli, $id);

    include_once __DIR__.'/../../BookmarkTags/deleteOnBookmark.php';
    \BookmarkTags\deleteOnBookmark($mysqli, $id);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, -1);

}
