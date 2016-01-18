<?php

namespace Users\Bookmarks;

function addDeleted ($mysqli, $id_users, $data) {

    $id = $data->id;
    $url = $data->url;
    $title = $data->title;
    $tags = $data->tags;
    $insert_time = $data->insert_time;
    $update_time = $data->update_time;

    $fnsDir = __DIR__.'/../..';

    include_once "$fnsDir/Tags/parse.php";
    $tag_names = \Tags\parse($tags);

    include_once "$fnsDir/Bookmarks/addDeleted.php";
    \Bookmarks\addDeleted($mysqli, $id, $id_users, $url, $title,
        $tags, $tag_names, $insert_time, $update_time, $data->revision);

    include_once "$fnsDir/BookmarkRevisions/setDeletedOnBookmark.php";
    \BookmarkRevisions\setDeletedOnBookmark($mysqli, $id, false);

    if ($tag_names) {
        include_once "$fnsDir/BookmarkTags/add.php";
        \BookmarkTags\add($mysqli, $id_users, $id,
            $tag_names, $url, $title, $insert_time, $update_time);
    }

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
