<?php

include_once '../fns/require_api_key.php';
list($apiKey, $user, $mysqli) = require_api_key();

include_once 'fns/require_bookmark_params.php';
list($url, $title, $tags, $tag_names) = require_bookmark_params();

include_once '../../fns/Users/Bookmarks/add.php';
$id = Users\Bookmarks\add($mysqli, $user->id_users,
    $url, $title, $tags, $tag_names);

header('Content-Type: application/json');
echo $id;
