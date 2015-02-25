<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key('can_write_bookmarks');

include_once 'fns/require_bookmark.php';
$bookmark = require_bookmark($mysqli, $user);

include_once 'fns/require_bookmark_params.php';
list($url, $title, $tags, $tag_names) = require_bookmark_params();

include_once '../../fns/Users/Bookmarks/edit.php';
Users\Bookmarks\edit($mysqli, $bookmark,
    $title, $url, $tags, $tag_names, $apiKey);

header('Content-Type: application/json');
echo 'true';
