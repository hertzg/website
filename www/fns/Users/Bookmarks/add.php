<?php

namespace Users\Bookmarks;

function add ($mysqli, $id_users, $url, $title, $tags, $tag_names) {

    include_once __DIR__.'/../../Bookmarks/add.php';
    $id = \Bookmarks\add($mysqli, $id_users, $url, $title, $tags);

    include_once __DIR__.'/../../BookmarkTags/add.php';
    \BookmarkTags\add($mysqli, $id_users, $id, $tag_names, $url, $title);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    return $id;

}
