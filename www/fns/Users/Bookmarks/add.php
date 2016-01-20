<?php

namespace Users\Bookmarks;

function add ($mysqli, $id_users, $url,
    $title, $tags, $tag_names, $insertApiKey = null) {

    $fnsDir = __DIR__.'/../..';

    $insert_time = $update_time = time();

    include_once "$fnsDir/Bookmarks/add.php";
    $id = \Bookmarks\add($mysqli, $id_users, $url, $title,
        $tags, $tag_names, $insert_time, $update_time, $insertApiKey);

    if ($tag_names) {
        include_once "$fnsDir/BookmarkTags/add.php";
        \BookmarkTags\add($mysqli, $id_users, $id,
            $tag_names, $url, $title, $insert_time, $update_time);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

    include_once "$fnsDir/BookmarkRevisions/add.php";
    \BookmarkRevisions\add($mysqli, $id, $id_users,
        $url, $title, $tags, $insert_time, 0);

    return $id;

}
