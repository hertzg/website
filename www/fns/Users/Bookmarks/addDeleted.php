<?php

namespace Users\Bookmarks;

function addDeleted ($mysqli, $id_users, $object) {

    $id = $object->id;
    $url = $object->url;
    $title = $object->title;
    $tags = $object->tags;

    include_once __DIR__.'/../../Tags/parse.php';
    $tag_names = \Tags\parse($tags);

    include_once __DIR__.'/../../Bookmarks/addDeleted.php';
    \Bookmarks\addDeleted($mysqli, $id, $id_users, $url, $title, $tags,
        $object->insert_time, $object->update_time);

    include_once __DIR__.'/../../BookmarkTags/add.php';
    \BookmarkTags\add($mysqli, $id_users, $id, $tag_names, $url, $title);

    include_once __DIR__.'/addNumber.php';
    addNumber($mysqli, $id_users, 1);

}
