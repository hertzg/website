<?php

include_once '../fns/require_api_key.php';
require_api_key('can_write_bookmarks', $apiKey, $user, $mysqli);

include_once 'fns/require_bookmark_params.php';
list($url, $title, $tags, $tag_names) = require_bookmark_params();

include_once '../../fns/Users/Bookmarks/add.php';
$id = Users\Bookmarks\add($mysqli, $user->id_users,
    $url, $title, $tags, $tag_names, $apiKey);

header('Content-Type: application/json');
echo $id;
