<?php

include_once '../fns/require_api_key.php';
list($apiKey, $id_users, $mysqli) = require_api_key();

include_once 'fns/require_bookmark_params.php';
list($url, $title, $tags, $tag_names) = require_bookmark_params();

include_once '../../fns/Bookmarks/add.php';
$id = Bookmarks\add($mysqli, $id_users, $url, $title, $tags);

include_once '../../fns/BookmarkTags/add.php';
BookmarkTags\add($mysqli, $id_users, $id, $tag_names, $url, $title);

header('Content-Type: application/json');
echo json_encode(['id' => $id]);
