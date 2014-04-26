<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();
$id_users = $user->id_users;

include_once 'fns/require_bookmark.php';
list($id, $bookmark) = require_bookmark($mysqli, $id_users);

include_once 'fns/require_bookmark_params.php';
list($url, $title, $tags, $tag_names) = require_bookmark_params();

include_once '../../fns/Bookmarks/edit.php';
Bookmarks\edit($mysqli, $id_users, $id, $title, $url, $tags);

include_once '../../fns/BookmarkTags/deleteOnBookmark.php';
BookmarkTags\deleteOnBookmark($mysqli, $id);

include_once '../../fns/BookmarkTags/add.php';
BookmarkTags\add($mysqli, $id_users, $id, $tag_names, $url, $title);

header('Content-Type: application/json');
echo 'true';
