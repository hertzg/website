<?php

namespace Users\Bookmarks;

function edit ($mysqli, $id_users, $id, $title, $url, $tags, $tag_names) {

    include_once __DIR__.'/../../Bookmarks/edit.php';
    \Bookmarks\edit($mysqli, $id_users, $id, $title, $url, $tags);

    include_once __DIR__.'/../../BookmarkTags/deleteOnBookmark.php';
    \BookmarkTags\deleteOnBookmark($mysqli, $id);

    include_once __DIR__.'/../../BookmarkTags/add.php';
    \BookmarkTags\add($mysqli, $id_users, $id, $tag_names, $url, $title);

}
