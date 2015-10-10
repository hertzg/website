<?php

namespace Users\Bookmarks;

function edit ($mysqli, $bookmark, $title, $url,
    $tags, $tag_names, &$changed, $updateApiKey = null) {

    if ($bookmark->title === $title &&
        $bookmark->url === $url && $bookmark->tags === $tags) return;

    $id = $bookmark->id;
    $fnsDir = __DIR__.'/../..';

    $update_time = time();

    include_once "$fnsDir/Bookmarks/edit.php";
    \Bookmarks\edit($mysqli, $id, $title, $url,
        $tags, $tag_names, $update_time, $updateApiKey);

    if ($bookmark->num_tags) {
        include_once "$fnsDir/BookmarkTags/deleteOnBookmark.php";
        \BookmarkTags\deleteOnBookmark($mysqli, $id);
    }

    if ($tag_names) {
        include_once "$fnsDir/BookmarkTags/add.php";
        \BookmarkTags\add($mysqli, $bookmark->id_users, $id,
            $tag_names, $url, $title, $bookmark->insert_time, $update_time);
    }

}
