<?php

namespace Users\Bookmarks;

function edit ($mysqli, $bookmark, $title, $url, $tags, $tag_names) {

    $id = $bookmark->id_bookmarks;
    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Bookmarks/edit.php";
    \Bookmarks\edit($mysqli, $id, $title, $url, $tags, $tag_names);

    include_once "$fnsDir/BookmarkTags/deleteOnBookmark.php";
    \BookmarkTags\deleteOnBookmark($mysqli, $id);

    if ($tag_names) {
        include_once "$fnsDir/BookmarkTags/add.php";
        \BookmarkTags\add($mysqli, $bookmark->id_users,
            $id, $tag_names, $url, $title);
    }

}
