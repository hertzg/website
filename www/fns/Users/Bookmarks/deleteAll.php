<?php

namespace Users\Bookmarks;

function deleteAll ($mysqli, $id_users) {

    include_once __DIR__.'/../../Bookmarks/deleteOnUser.php';
    \Bookmarks\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/../../BookmarkTags/deleteOnUser.php';
    \BookmarkTags\deleteOnUser($mysqli, $id_users);

    include_once __DIR__.'/clearNumber.php';
    clearNumber($mysqli, $id_users);

}
