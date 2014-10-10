<?php

namespace Users\Bookmarks;

function add ($mysqli, $id_users, $url, $title, $tags, $tag_names) {

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Bookmarks/add.php";
    $id = \Bookmarks\add($mysqli, $id_users, $url, $title, $tags, $tag_names);

    include_once "$fnsDir/BookmarkTags/add.php";
    \BookmarkTags\add($mysqli, $id_users, $id, $tag_names, $url, $title);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
