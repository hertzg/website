<?php

include_once '../../../lib/defaults.php';

include_once '../fns/require_api_key.php';
require_api_key('bookmark/edit',
    'can_write_bookmarks', $apiKey, $user, $mysqli);

include_once 'fns/require_bookmark.php';
$bookmark = require_bookmark($mysqli, $user);

include_once 'fns/require_bookmark_params.php';
require_bookmark_params($url, $title, $tags, $tag_names);

include_once '../../fns/Users/Bookmarks/edit.php';
Users\Bookmarks\edit($mysqli, $bookmark, $title,
    $url, $tags, $tag_names, $changed, $apiKey);

header('Content-Type: application/json');
echo 'true';
