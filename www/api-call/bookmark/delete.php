<?php

include_once '../fns/require_api_key.php';
list($apiKey, $id_users, $mysqli) = require_api_key();

include_once 'fns/require_bookmark.php';
list($id, $bookmark) = require_bookmark($mysqli, $id_users);

include_once '../../fns/Bookmarks/delete.php';
Bookmarks\delete($mysqli, $id);

include_once '../../fns/BookmarkTags/deleteOnBookmark.php';
BookmarkTags\deleteOnBookmark($mysqli, $id);

include_once '../../fns/Users/addNumBookmarks.php';
Users\addNumBookmarks($mysqli, $id_users, -1);

header('Content-Type: application/json');
echo 'true';
